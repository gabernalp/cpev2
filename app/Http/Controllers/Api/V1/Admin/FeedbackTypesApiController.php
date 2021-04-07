<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeedbackTypeRequest;
use App\Http\Requests\UpdateFeedbackTypeRequest;
use App\Http\Resources\Admin\FeedbackTypeResource;
use App\Models\FeedbackType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FeedbackTypesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('feedback_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FeedbackTypeResource(FeedbackType::all());
    }

    public function store(StoreFeedbackTypeRequest $request)
    {
        $feedbackType = FeedbackType::create($request->all());

        return (new FeedbackTypeResource($feedbackType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FeedbackType $feedbackType)
    {
        abort_if(Gate::denies('feedback_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FeedbackTypeResource($feedbackType);
    }

    public function update(UpdateFeedbackTypeRequest $request, FeedbackType $feedbackType)
    {
        $feedbackType->update($request->all());

        return (new FeedbackTypeResource($feedbackType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FeedbackType $feedbackType)
    {
        abort_if(Gate::denies('feedback_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feedbackType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
