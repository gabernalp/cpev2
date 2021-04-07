<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBackgroundProcessRequest;
use App\Http\Requests\UpdateBackgroundProcessRequest;
use App\Http\Resources\Admin\BackgroundProcessResource;
use App\Models\BackgroundProcess;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BackgroundProcessesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('background_process_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BackgroundProcessResource(BackgroundProcess::with(['tags'])->get());
    }

    public function store(StoreBackgroundProcessRequest $request)
    {
        $backgroundProcess = BackgroundProcess::create($request->all());
        $backgroundProcess->tags()->sync($request->input('tags', []));

        if ($request->input('file', false)) {
            $backgroundProcess->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        if ($request->input('images', false)) {
            $backgroundProcess->addMedia(storage_path('tmp/uploads/' . basename($request->input('images'))))->toMediaCollection('images');
        }

        return (new BackgroundProcessResource($backgroundProcess))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BackgroundProcess $backgroundProcess)
    {
        abort_if(Gate::denies('background_process_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BackgroundProcessResource($backgroundProcess->load(['tags']));
    }

    public function update(UpdateBackgroundProcessRequest $request, BackgroundProcess $backgroundProcess)
    {
        $backgroundProcess->update($request->all());
        $backgroundProcess->tags()->sync($request->input('tags', []));

        if ($request->input('file', false)) {
            if (!$backgroundProcess->file || $request->input('file') !== $backgroundProcess->file->file_name) {
                if ($backgroundProcess->file) {
                    $backgroundProcess->file->delete();
                }

                $backgroundProcess->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
            }
        } elseif ($backgroundProcess->file) {
            $backgroundProcess->file->delete();
        }

        if ($request->input('images', false)) {
            if (!$backgroundProcess->images || $request->input('images') !== $backgroundProcess->images->file_name) {
                if ($backgroundProcess->images) {
                    $backgroundProcess->images->delete();
                }

                $backgroundProcess->addMedia(storage_path('tmp/uploads/' . basename($request->input('images'))))->toMediaCollection('images');
            }
        } elseif ($backgroundProcess->images) {
            $backgroundProcess->images->delete();
        }

        return (new BackgroundProcessResource($backgroundProcess))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BackgroundProcess $backgroundProcess)
    {
        abort_if(Gate::denies('background_process_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $backgroundProcess->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
