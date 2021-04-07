<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBadgesUserRequest;
use App\Http\Requests\StoreBadgesUserRequest;
use App\Http\Requests\UpdateBadgesUserRequest;
use App\Models\Badge;
use App\Models\BadgesUser;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BadgesUsersController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('badges_user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BadgesUser::with(['programmed_course', 'user', 'badge', 'created_by'])->select(sprintf('%s.*', (new BadgesUser)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'badges_user_show';
                $editGate      = 'badges_user_edit';
                $deleteGate    = 'badges_user_delete';
                $crudRoutePart = 'badges-users';

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
            $table->addColumn('programmed_course_start_date', function ($row) {
                return $row->programmed_course ? $row->programmed_course->start_date : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('user.last_name', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->last_name) : '';
            });
            $table->editColumn('user.document', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->document) : '';
            });
            $table->addColumn('badge_name', function ($row) {
                return $row->badge ? $row->badge->name : '';
            });

            $table->editColumn('badge.points', function ($row) {
                return $row->badge ? (is_string($row->badge) ? $row->badge : $row->badge->points) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'programmed_course', 'user', 'badge']);

            return $table->make(true);
        }

        return view('admin.badgesUsers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('badges_user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $badges = Badge::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.badgesUsers.create', compact('users', 'badges'));
    }

    public function store(StoreBadgesUserRequest $request)
    {
        $badgesUser = BadgesUser::create($request->all());

        return redirect()->route('admin.badges-users.index');
    }

    public function edit(BadgesUser $badgesUser)
    {
        abort_if(Gate::denies('badges_user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $badges = Badge::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $badgesUser->load('programmed_course', 'user', 'badge', 'created_by');

        return view('admin.badgesUsers.edit', compact('users', 'badges', 'badgesUser'));
    }

    public function update(UpdateBadgesUserRequest $request, BadgesUser $badgesUser)
    {
        $badgesUser->update($request->all());

        return redirect()->route('admin.badges-users.index');
    }

    public function show(BadgesUser $badgesUser)
    {
        abort_if(Gate::denies('badges_user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $badgesUser->load('programmed_course', 'user', 'badge', 'created_by');

        return view('admin.badgesUsers.show', compact('badgesUser'));
    }

    public function destroy(BadgesUser $badgesUser)
    {
        abort_if(Gate::denies('badges_user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $badgesUser->delete();

        return back();
    }

    public function massDestroy(MassDestroyBadgesUserRequest $request)
    {
        BadgesUser::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
