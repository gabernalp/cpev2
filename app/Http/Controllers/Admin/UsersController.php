<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\City;
use App\Models\Department;
use App\Models\Device;
use App\Models\DocumentType;
use App\Models\Operator;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = User::with(['documenttype', 'department', 'city', 'devices', 'roles', 'operator'])->select(sprintf('%s.*', (new User)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'user_show';
                $editGate      = 'user_edit';
                $deleteGate    = 'user_delete';
                $crudRoutePart = 'users';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->addColumn('documenttype_name', function ($row) {
                return $row->documenttype ? $row->documenttype->name : '';
            });

            $table->editColumn('document', function ($row) {
                return $row->document ? $row->document : "";
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('last_name', function ($row) {
                return $row->last_name ? $row->last_name : "";
            });
            $table->editColumn('gender', function ($row) {
                return $row->gender ? User::GENDER_SELECT[$row->gender] : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : "";
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : "";
            });
            $table->editColumn('phone_2', function ($row) {
                return $row->phone_2 ? $row->phone_2 : "";
            });
            $table->addColumn('department_name', function ($row) {
                return $row->department ? $row->department->name : '';
            });

            $table->addColumn('city_name', function ($row) {
                return $row->city ? $row->city->name : '';
            });

            $table->editColumn('zona', function ($row) {
                return $row->zona ? User::ZONA_SELECT[$row->zona] : '';
            });
            $table->editColumn('etnia', function ($row) {
                return $row->etnia ? User::ETNIA_SELECT[$row->etnia] : '';
            });
            $table->editColumn('academic_background', function ($row) {
                return $row->academic_background ? User::ACADEMIC_BACKGROUND_SELECT[$row->academic_background] : '';
            });
            $table->editColumn('devices', function ($row) {
                $labels = [];

                foreach ($row->devices as $device) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $device->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('roles', function ($row) {
                $labels = [];

                foreach ($row->roles as $role) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $role->title);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('place_role', function ($row) {
                return $row->place_role ? User::PLACE_ROLE_SELECT[$row->place_role] : '';
            });
            $table->editColumn('labour_role', function ($row) {
                return $row->labour_role ? User::LABOUR_ROLE_SELECT[$row->labour_role] : '';
            });
            $table->editColumn('modality', function ($row) {
                return $row->modality ? User::MODALITY_SELECT[$row->modality] : '';
            });
            $table->editColumn('entity', function ($row) {
                return $row->entity ? $row->entity : "";
            });
            $table->addColumn('operator_name', function ($row) {
                return $row->operator ? $row->operator->name : '';
            });

            $table->editColumn('newsletter_subscription', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->newsletter_subscription ? 'checked' : null) . '>';
            });
            $table->editColumn('motivation', function ($row) {
                return $row->motivation ? $row->motivation : "";
            });
            $table->editColumn('experience', function ($row) {
                return $row->experience ? User::EXPERIENCE_SELECT[$row->experience] : '';
            });

            $table->editColumn('verified', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->verified ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'documenttype', 'department', 'city', 'devices', 'roles', 'operator', 'newsletter_subscription', 'verified']);

            return $table->make(true);
        }

        return view('admin.users.index');
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documenttypes = DocumentType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $departments = Department::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $devices = Device::all()->pluck('name', 'id');

        $roles = Role::all()->pluck('title', 'id');

        $operators = Operator::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.users.create', compact('documenttypes', 'departments', 'cities', 'devices', 'roles', 'operators'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->devices()->sync($request->input('devices', []));
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documenttypes = DocumentType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $departments = Department::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $devices = Device::all()->pluck('name', 'id');

        $roles = Role::all()->pluck('title', 'id');

        $operators = Operator::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user->load('documenttype', 'department', 'city', 'devices', 'roles', 'operator');

        return view('admin.users.edit', compact('documenttypes', 'departments', 'cities', 'devices', 'roles', 'operators', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->devices()->sync($request->input('devices', []));
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('documenttype', 'department', 'city', 'devices', 'roles', 'operator', 'userFeedbacksUsers', 'userCoursesUsers', 'userChallengesUsers', 'userMeetings', 'userUserChainBlocks', 'userBadgesUsers', 'userUserAlerts', 'tutorsCourseSchedules');

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
