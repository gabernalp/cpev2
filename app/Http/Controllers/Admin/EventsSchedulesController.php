<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEventsScheduleRequest;
use App\Http\Requests\StoreEventsScheduleRequest;
use App\Http\Requests\UpdateEventsScheduleRequest;
use App\Models\EventsSchedule;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class EventsSchedulesController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('events_schedule_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventsSchedules = EventsSchedule::with(['media'])->get();

        return view('admin.eventsSchedules.index', compact('eventsSchedules'));
    }

    public function create()
    {
        abort_if(Gate::denies('events_schedule_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.eventsSchedules.create');
    }

    public function store(StoreEventsScheduleRequest $request)
    {
        $eventsSchedule = EventsSchedule::create($request->all());

        if ($request->input('image', false)) {
            $eventsSchedule->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($request->input('podcast', false)) {
            $eventsSchedule->addMedia(storage_path('tmp/uploads/' . basename($request->input('podcast'))))->toMediaCollection('podcast');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $eventsSchedule->id]);
        }

        return redirect()->route('admin.events-schedules.index');
    }

    public function edit(EventsSchedule $eventsSchedule)
    {
        abort_if(Gate::denies('events_schedule_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.eventsSchedules.edit', compact('eventsSchedule'));
    }

    public function update(UpdateEventsScheduleRequest $request, EventsSchedule $eventsSchedule)
    {
        $eventsSchedule->update($request->all());

        if ($request->input('image', false)) {
            if (!$eventsSchedule->image || $request->input('image') !== $eventsSchedule->image->file_name) {
                if ($eventsSchedule->image) {
                    $eventsSchedule->image->delete();
                }

                $eventsSchedule->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($eventsSchedule->image) {
            $eventsSchedule->image->delete();
        }

        if ($request->input('podcast', false)) {
            if (!$eventsSchedule->podcast || $request->input('podcast') !== $eventsSchedule->podcast->file_name) {
                if ($eventsSchedule->podcast) {
                    $eventsSchedule->podcast->delete();
                }

                $eventsSchedule->addMedia(storage_path('tmp/uploads/' . basename($request->input('podcast'))))->toMediaCollection('podcast');
            }
        } elseif ($eventsSchedule->podcast) {
            $eventsSchedule->podcast->delete();
        }

        return redirect()->route('admin.events-schedules.index');
    }

    public function show(EventsSchedule $eventsSchedule)
    {
        abort_if(Gate::denies('events_schedule_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.eventsSchedules.show', compact('eventsSchedule'));
    }

    public function destroy(EventsSchedule $eventsSchedule)
    {
        abort_if(Gate::denies('events_schedule_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventsSchedule->delete();

        return back();
    }

    public function massDestroy(MassDestroyEventsScheduleRequest $request)
    {
        EventsSchedule::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('events_schedule_create') && Gate::denies('events_schedule_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new EventsSchedule();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
