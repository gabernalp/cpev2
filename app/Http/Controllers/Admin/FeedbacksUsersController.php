<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyFeedbacksUserRequest;
use App\Http\Requests\StoreFeedbacksUserRequest;
use App\Http\Requests\UpdateFeedbacksUserRequest;
use App\Models\FeedbacksUser;
use App\Models\FeedbackType;
use App\Models\ReferenceType;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FeedbacksUsersController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('feedbacks_user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FeedbacksUser::with(['programmed_course', 'user', 'feedbacktype', 'referencetype', 'created_by'])->select(sprintf('%s.*', (new FeedbacksUser)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'feedbacks_user_show';
                $editGate      = 'feedbacks_user_edit';
                $deleteGate    = 'feedbacks_user_delete';
                $crudRoutePart = 'feedbacks-users';

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
            $table->addColumn('feedbacktype_name', function ($row) {
                return $row->feedbacktype ? $row->feedbacktype->name : '';
            });

            $table->addColumn('referencetype_name', function ($row) {
                return $row->referencetype ? $row->referencetype->name : '';
            });

            $table->editColumn('file', function ($row) {
                return $row->file ? '<a href="' . $row->file->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : "";
            });
            $table->editColumn('link', function ($row) {
                return $row->link ? $row->link : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'programmed_course', 'user', 'feedbacktype', 'referencetype', 'file']);

            return $table->make(true);
        }

        return view('admin.feedbacksUsers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('feedbacks_user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $feedbacktypes = FeedbackType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $referencetypes = ReferenceType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.feedbacksUsers.create', compact('users', 'feedbacktypes', 'referencetypes'));
    }

    public function store(StoreFeedbacksUserRequest $request)
    {
        $feedbacksUser = FeedbacksUser::create($request->all());

        if ($request->input('file', false)) {
            $feedbacksUser->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $feedbacksUser->id]);
        }

        return redirect()->route('admin.feedbacks-users.index');
    }

    public function edit(FeedbacksUser $feedbacksUser)
    {
        abort_if(Gate::denies('feedbacks_user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $feedbacktypes = FeedbackType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $referencetypes = ReferenceType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $feedbacksUser->load('programmed_course', 'user', 'feedbacktype', 'referencetype', 'created_by');

        return view('admin.feedbacksUsers.edit', compact('users', 'feedbacktypes', 'referencetypes', 'feedbacksUser'));
    }

    public function update(UpdateFeedbacksUserRequest $request, FeedbacksUser $feedbacksUser)
    {
        $feedbacksUser->update($request->all());

        if ($request->input('file', false)) {
            if (!$feedbacksUser->file || $request->input('file') !== $feedbacksUser->file->file_name) {
                if ($feedbacksUser->file) {
                    $feedbacksUser->file->delete();
                }

                $feedbacksUser->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
            }
        } elseif ($feedbacksUser->file) {
            $feedbacksUser->file->delete();
        }

        return redirect()->route('admin.feedbacks-users.index');
    }

    public function show(FeedbacksUser $feedbacksUser)
    {
        abort_if(Gate::denies('feedbacks_user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feedbacksUser->load('programmed_course', 'user', 'feedbacktype', 'referencetype', 'created_by');

        return view('admin.feedbacksUsers.show', compact('feedbacksUser'));
    }

    public function destroy(FeedbacksUser $feedbacksUser)
    {
        abort_if(Gate::denies('feedbacks_user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feedbacksUser->delete();

        return back();
    }

    public function massDestroy(MassDestroyFeedbacksUserRequest $request)
    {
        FeedbacksUser::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('feedbacks_user_create') && Gate::denies('feedbacks_user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new FeedbacksUser();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
