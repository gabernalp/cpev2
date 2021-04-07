<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreReferenceObjectRequest;
use App\Http\Requests\UpdateReferenceObjectRequest;
use App\Http\Resources\Admin\ReferenceObjectResource;
use App\Models\ReferenceObject;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReferenceObjectsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('reference_object_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReferenceObjectResource(ReferenceObject::with(['referencetype', 'tags'])->get());
    }

    public function store(StoreReferenceObjectRequest $request)
    {
        $referenceObject = ReferenceObject::create($request->all());
        $referenceObject->tags()->sync($request->input('tags', []));

        if ($request->input('file', false)) {
            $referenceObject->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        return (new ReferenceObjectResource($referenceObject))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ReferenceObject $referenceObject)
    {
        abort_if(Gate::denies('reference_object_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReferenceObjectResource($referenceObject->load(['referencetype', 'tags']));
    }

    public function update(UpdateReferenceObjectRequest $request, ReferenceObject $referenceObject)
    {
        $referenceObject->update($request->all());
        $referenceObject->tags()->sync($request->input('tags', []));

        if ($request->input('file', false)) {
            if (!$referenceObject->file || $request->input('file') !== $referenceObject->file->file_name) {
                if ($referenceObject->file) {
                    $referenceObject->file->delete();
                }

                $referenceObject->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
            }
        } elseif ($referenceObject->file) {
            $referenceObject->file->delete();
        }

        return (new ReferenceObjectResource($referenceObject))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ReferenceObject $referenceObject)
    {
        abort_if(Gate::denies('reference_object_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $referenceObject->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
