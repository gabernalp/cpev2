<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyChallengesUserRequest;
use App\Http\Requests\StoreChallengesUserRequest;
use App\Http\Requests\UpdateChallengesUserRequest;
use App\Models\Challenge;
use App\Models\ChallengesUser;
use App\Models\CourseSchedule;
use App\Models\ReferenceType;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ChallengesUsersController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('challenges_user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $challengesUsers = ChallengesUser::with(['challenge', 'user', 'courseschedule', 'referencetype', 'created_by', 'media'])->get();

        $challenges = Challenge::get();

        $users = User::get();

        $course_schedules = CourseSchedule::get();

        $reference_types = ReferenceType::get();

        return view('admin.challengesUsers.index', compact('challengesUsers', 'challenges', 'users', 'course_schedules', 'reference_types'));
    }

    public function create()
    {
        abort_if(Gate::denies('challenges_user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $challenges = Challenge::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $courseschedules = CourseSchedule::all()->pluck('start_date', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.challengesUsers.create', compact('challenges', 'users', 'courseschedules'));
    }

    public function store(StoreChallengesUserRequest $request)
    {
        $challengesUser = ChallengesUser::create($request->all());

        if ($request->input('file', false)) {
            $challengesUser->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $challengesUser->id]);
        }

        return redirect()->route('admin.challenges-users.index');
    }

    public function edit(ChallengesUser $challengesUser)
    {
        abort_if(Gate::denies('challenges_user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $challenges = Challenge::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $courseschedules = CourseSchedule::all()->pluck('start_date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $challengesUser->load('challenge', 'user', 'courseschedule', 'referencetype', 'created_by');

        return view('admin.challengesUsers.edit', compact('challenges', 'users', 'courseschedules', 'challengesUser'));
    }

    public function update(UpdateChallengesUserRequest $request, ChallengesUser $challengesUser)
    {
        $challengesUser->update($request->all());

        if ($request->input('file', false)) {
            if (!$challengesUser->file || $request->input('file') !== $challengesUser->file->file_name) {
                if ($challengesUser->file) {
                    $challengesUser->file->delete();
                }

                $challengesUser->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
            }
        } elseif ($challengesUser->file) {
            $challengesUser->file->delete();
        }

        return redirect()->route('admin.challenges-users.index');
    }

    public function show(ChallengesUser $challengesUser)
    {
        abort_if(Gate::denies('challenges_user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $challengesUser->load('challenge', 'user', 'courseschedule', 'referencetype', 'created_by');

        return view('admin.challengesUsers.show', compact('challengesUser'));
    }

    public function destroy(ChallengesUser $challengesUser)
    {
        abort_if(Gate::denies('challenges_user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $challengesUser->delete();

        return back();
    }

    public function massDestroy(MassDestroyChallengesUserRequest $request)
    {
        ChallengesUser::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('challenges_user_create') && Gate::denies('challenges_user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ChallengesUser();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
