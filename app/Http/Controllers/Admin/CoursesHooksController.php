<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCoursesHookRequest;
use App\Http\Requests\StoreCoursesHookRequest;
use App\Http\Requests\UpdateCoursesHookRequest;
use App\Models\CoursesHook;
use App\Models\Department;
use App\Models\Entity;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CoursesHooksController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('courses_hook_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CoursesHook::with(['entities', 'departments'])->select(sprintf('%s.*', (new CoursesHook)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'courses_hook_show';
                $editGate      = 'courses_hook_edit';
                $deleteGate    = 'courses_hook_delete';
                $crudRoutePart = 'courses-hooks';

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
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : "";
            });
            $table->editColumn('specific_category', function ($row) {
                return $row->specific_category ? $row->specific_category : "";
            });
            $table->editColumn('entity', function ($row) {
                $labels = [];

                foreach ($row->entities as $entity) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $entity->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('department', function ($row) {
                $labels = [];

                foreach ($row->departments as $department) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $department->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('requirements', function ($row) {
                return $row->requirements ? $row->requirements : "";
            });
            $table->editColumn('link', function ($row) {
                return $row->link ? $row->link : "";
            });
            $table->editColumn('priorized', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->priorized ? 'checked' : null) . '>';
            });
            $table->editColumn('exclusive', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->exclusive ? 'checked' : null) . '>';
            });
            $table->editColumn('educational_level_exclusive', function ($row) {
                return $row->educational_level_exclusive ? CoursesHook::EDUCATIONAL_LEVEL_EXCLUSIVE_SELECT[$row->educational_level_exclusive] : '';
            });
            $table->editColumn('community', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->community ? 'checked' : null) . '>';
            });
            $table->editColumn('institutional', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->institutional ? 'checked' : null) . '>';
            });
            $table->editColumn('family', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->family ? 'checked' : null) . '>';
            });
            $table->editColumn('intercultural', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->intercultural ? 'checked' : null) . '>';
            });
            $table->editColumn('coordinator', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->coordinator ? 'checked' : null) . '>';
            });
            $table->editColumn('educational_group', function ($row) {
                return $row->educational_group ? CoursesHook::EDUCATIONAL_GROUP_SELECT[$row->educational_group] : '';
            });
            $table->editColumn('educational_level', function ($row) {
                return $row->educational_level ? CoursesHook::EDUCATIONAL_LEVEL_SELECT[$row->educational_level] : '';
            });
            $table->editColumn('file', function ($row) {
                return $row->file ? '<a href="' . $row->file->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'entity', 'department', 'priorized', 'exclusive', 'community', 'institutional', 'family', 'intercultural', 'coordinator', 'file']);

            return $table->make(true);
        }

        return view('admin.coursesHooks.index');
    }

    public function create()
    {
        abort_if(Gate::denies('courses_hook_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entities = Entity::all()->pluck('name', 'id');

        $departments = Department::all()->pluck('name', 'id');

        return view('admin.coursesHooks.create', compact('entities', 'departments'));
    }

    public function store(StoreCoursesHookRequest $request)
    {
        $coursesHook = CoursesHook::create($request->all());
        $coursesHook->entities()->sync($request->input('entities', []));
        $coursesHook->departments()->sync($request->input('departments', []));

        if ($request->input('file', false)) {
            $coursesHook->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $coursesHook->id]);
        }

        return redirect()->route('admin.courses-hooks.index');
    }

    public function edit(CoursesHook $coursesHook)
    {
        abort_if(Gate::denies('courses_hook_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entities = Entity::all()->pluck('name', 'id');

        $departments = Department::all()->pluck('name', 'id');

        $coursesHook->load('entities', 'departments');

        return view('admin.coursesHooks.edit', compact('entities', 'departments', 'coursesHook'));
    }

    public function update(UpdateCoursesHookRequest $request, CoursesHook $coursesHook)
    {
        $coursesHook->update($request->all());
        $coursesHook->entities()->sync($request->input('entities', []));
        $coursesHook->departments()->sync($request->input('departments', []));

        if ($request->input('file', false)) {
            if (!$coursesHook->file || $request->input('file') !== $coursesHook->file->file_name) {
                if ($coursesHook->file) {
                    $coursesHook->file->delete();
                }

                $coursesHook->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
            }
        } elseif ($coursesHook->file) {
            $coursesHook->file->delete();
        }

        return redirect()->route('admin.courses-hooks.index');
    }

    public function show(CoursesHook $coursesHook)
    {
        abort_if(Gate::denies('courses_hook_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coursesHook->load('entities', 'departments', 'courseshooksCourses', 'courseshooksSelfInterestedUsers');

        return view('admin.coursesHooks.show', compact('coursesHook'));
    }

    public function destroy(CoursesHook $coursesHook)
    {
        abort_if(Gate::denies('courses_hook_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coursesHook->delete();

        return back();
    }

    public function massDestroy(MassDestroyCoursesHookRequest $request)
    {
        CoursesHook::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('courses_hook_create') && Gate::denies('courses_hook_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new CoursesHook();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
