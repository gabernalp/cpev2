<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreFeedbacksUserRequest;
use App\Http\Requests\UpdateFeedbacksUserRequest;
use App\Http\Resources\Admin\FeedbacksUserResource;
use App\Models\FeedbacksUser;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FeedbacksUsersApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('feedbacks_user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FeedbacksUserResource(FeedbacksUser::with(['programmed_course', 'user', 'feedbacktype', 'referencetype', 'created_by'])->get());
    }

    public function store(StoreFeedbacksUserRequest $request)
    {
        $feedbacksUser = FeedbacksUser::create($request->all());

        if ($request->input('file', false)) {
            $feedbacksUser->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        return (new FeedbacksUserResource($feedbacksUser))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FeedbacksUser $feedbacksUser)
    {
        abort_if(Gate::denies('feedbacks_user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FeedbacksUserResource($feedbacksUser->load(['programmed_course', 'user', 'feedbacktype', 'referencetype', 'created_by']));
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

        return (new FeedbacksUserResource($feedbacksUser))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FeedbacksUser $feedbacksUser)
    {
        abort_if(Gate::denies('feedbacks_user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feedbacksUser->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
