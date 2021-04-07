<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyChallengeRequest;
use App\Http\Requests\StoreChallengeRequest;
use App\Http\Requests\UpdateChallengeRequest;
use App\Models\Challenge;
use App\Models\Course;
use App\Models\PointsRule;
use App\Models\ReferenceType;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ChallengesController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('challenge_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Challenge::with(['courses', 'referencetype', 'points'])->select(sprintf('%s.*', (new Challenge)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'challenge_show';
                $editGate      = 'challenge_edit';
                $deleteGate    = 'challenge_delete';
                $crudRoutePart = 'challenges';

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
            $table->editColumn('courses', function ($row) {
                $labels = [];

                foreach ($row->courses as $course) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $course->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : "";
            });
            $table->editColumn('goal', function ($row) {
                return $row->goal ? $row->goal : "";
            });
            $table->editColumn('capsule', function ($row) {
                return $row->capsule ? $row->capsule : "";
            });
            $table->editColumn('capsule_content', function ($row) {
                return $row->capsule_content ? $row->capsule_content : "";
            });
            $table->editColumn('capsule_file', function ($row) {
                return $row->capsule_file ? '<a href="' . $row->capsule_file->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('challenge_action', function ($row) {
                return $row->challenge_action ? Challenge::CHALLENGE_ACTION_SELECT[$row->challenge_action] : '';
            });
            $table->editColumn('action_detail', function ($row) {
                return $row->action_detail ? $row->action_detail : "";
            });
            $table->editColumn('limit_time', function ($row) {
                return $row->limit_time ? Challenge::LIMIT_TIME_SELECT[$row->limit_time] : '';
            });
            $table->addColumn('referencetype_name', function ($row) {
                return $row->referencetype ? $row->referencetype->name : '';
            });

            $table->editColumn('hours_adding', function ($row) {
                return $row->hours_adding ? $row->hours_adding : "";
            });
            $table->editColumn('points', function ($row) {
                $labels = [];

                foreach ($row->points as $point) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $point->points_item);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'courses', 'capsule_file', 'referencetype', 'points']);

            return $table->make(true);
        }

        return view('admin.challenges.index');
    }

    public function create()
    {
        abort_if(Gate::denies('challenge_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::all()->pluck('name', 'id');

        $referencetypes = ReferenceType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $points = PointsRule::all()->pluck('points_item', 'id');

        return view('admin.challenges.create', compact('courses', 'referencetypes', 'points'));
    }

    public function store(StoreChallengeRequest $request)
    {
        $challenge = Challenge::create($request->all());
        $challenge->courses()->sync($request->input('courses', []));
        $challenge->points()->sync($request->input('points', []));

        if ($request->input('capsule_file', false)) {
            $challenge->addMedia(storage_path('tmp/uploads/' . basename($request->input('capsule_file'))))->toMediaCollection('capsule_file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $challenge->id]);
        }

        return redirect()->route('admin.challenges.index');
    }

    public function edit(Challenge $challenge)
    {
        abort_if(Gate::denies('challenge_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::all()->pluck('name', 'id');

        $referencetypes = ReferenceType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $points = PointsRule::all()->pluck('points_item', 'id');

        $challenge->load('courses', 'referencetype', 'points');

        return view('admin.challenges.edit', compact('courses', 'referencetypes', 'points', 'challenge'));
    }

    public function update(UpdateChallengeRequest $request, Challenge $challenge)
    {
        $challenge->update($request->all());
        $challenge->courses()->sync($request->input('courses', []));
        $challenge->points()->sync($request->input('points', []));

        if ($request->input('capsule_file', false)) {
            if (!$challenge->capsule_file || $request->input('capsule_file') !== $challenge->capsule_file->file_name) {
                if ($challenge->capsule_file) {
                    $challenge->capsule_file->delete();
                }

                $challenge->addMedia(storage_path('tmp/uploads/' . basename($request->input('capsule_file'))))->toMediaCollection('capsule_file');
            }
        } elseif ($challenge->capsule_file) {
            $challenge->capsule_file->delete();
        }

        return redirect()->route('admin.challenges.index');
    }

    public function show(Challenge $challenge)
    {
        abort_if(Gate::denies('challenge_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $challenge->load('courses', 'referencetype', 'points', 'challengeChallengesUsers');

        return view('admin.challenges.show', compact('challenge'));
    }

    public function destroy(Challenge $challenge)
    {
        abort_if(Gate::denies('challenge_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $challenge->delete();

        return back();
    }

    public function massDestroy(MassDestroyChallengeRequest $request)
    {
        Challenge::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('challenge_create') && Gate::denies('challenge_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Challenge();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
