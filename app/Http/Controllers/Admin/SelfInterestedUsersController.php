<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySelfInterestedUserRequest;
use App\Http\Requests\StoreSelfInterestedUserRequest;
use App\Http\Requests\UpdateSelfInterestedUserRequest;
use App\Models\City;
use App\Models\CoursesHook;
use App\Models\Department;
use App\Models\DocumentType;
use App\Models\SelfInterestedUser;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SelfInterestedUsersController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('self_interested_user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SelfInterestedUser::with(['documenttype', 'department', 'city', 'courseshooks'])->select(sprintf('%s.*', (new SelfInterestedUser)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'self_interested_user_show';
                $editGate      = 'self_interested_user_edit';
                $deleteGate    = 'self_interested_user_delete';
                $crudRoutePart = 'self-interested-users';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('lastname', function ($row) {
                return $row->lastname ? $row->lastname : "";
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : "";
            });
            $table->addColumn('documenttype_name', function ($row) {
                return $row->documenttype ? $row->documenttype->name : '';
            });

            $table->editColumn('document', function ($row) {
                return $row->document ? $row->document : "";
            });

            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : "";
            });
            $table->editColumn('education_background', function ($row) {
                return $row->education_background ? SelfInterestedUser::EDUCATION_BACKGROUND_RADIO[$row->education_background] : '';
            });
            $table->editColumn('modality', function ($row) {
                return $row->modality ? SelfInterestedUser::MODALITY_SELECT[$row->modality] : '';
            });
            $table->addColumn('department_name', function ($row) {
                return $row->department ? $row->department->name : '';
            });

            $table->addColumn('city_name', function ($row) {
                return $row->city ? $row->city->name : '';
            });

            $table->editColumn('living_zone', function ($row) {
                return $row->living_zone ? SelfInterestedUser::LIVING_ZONE_SELECT[$row->living_zone] : '';
            });
            $table->editColumn('contacted', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->contacted ? 'checked' : null) . '>';
            });
            $table->editColumn('courseshooks', function ($row) {
                $labels = [];

                foreach ($row->courseshooks as $courseshook) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $courseshook->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'documenttype', 'department', 'city', 'contacted', 'courseshooks']);

            return $table->make(true);
        }

        return view('admin.selfInterestedUsers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('self_interested_user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documenttypes = DocumentType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $departments = Department::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $courseshooks = CoursesHook::all()->pluck('name', 'id');

        return view('admin.selfInterestedUsers.create', compact('documenttypes', 'departments', 'cities', 'courseshooks'));
    }

    public function store(StoreSelfInterestedUserRequest $request)
    {
        $selfInterestedUser = SelfInterestedUser::create($request->all());
        $selfInterestedUser->courseshooks()->sync($request->input('courseshooks', []));

        return redirect()->route('admin.self-interested-users.index');
    }

    public function edit(SelfInterestedUser $selfInterestedUser)
    {
        abort_if(Gate::denies('self_interested_user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documenttypes = DocumentType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $departments = Department::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $courseshooks = CoursesHook::all()->pluck('name', 'id');

        $selfInterestedUser->load('documenttype', 'department', 'city', 'courseshooks');

        return view('admin.selfInterestedUsers.edit', compact('documenttypes', 'departments', 'cities', 'courseshooks', 'selfInterestedUser'));
    }

    public function update(UpdateSelfInterestedUserRequest $request, SelfInterestedUser $selfInterestedUser)
    {
        $selfInterestedUser->update($request->all());
        $selfInterestedUser->courseshooks()->sync($request->input('courseshooks', []));

        return redirect()->route('admin.self-interested-users.index');
    }

    public function show(SelfInterestedUser $selfInterestedUser)
    {
        abort_if(Gate::denies('self_interested_user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $selfInterestedUser->load('documenttype', 'department', 'city', 'courseshooks');

        return view('admin.selfInterestedUsers.show', compact('selfInterestedUser'));
    }

    public function destroy(SelfInterestedUser $selfInterestedUser)
    {
        abort_if(Gate::denies('self_interested_user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $selfInterestedUser->delete();

        return back();
    }

    public function massDestroy(MassDestroySelfInterestedUserRequest $request)
    {
        SelfInterestedUser::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
