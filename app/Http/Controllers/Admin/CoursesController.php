<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCourseRequest;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\BackgroundProcess;
use App\Models\Course;
use App\Models\CoursesHook;
use App\Models\Department;
use App\Models\Operator;
use App\Models\ReferenceObject;
use App\Models\Role;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CoursesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('course_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Course::with(['associated_processes', 'roles', 'focalizacion_territorials', 'operators', 'references', 'courseshooks'])->select(sprintf('%s.*', (new Course)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'course_show';
                $editGate      = 'course_edit';
                $deleteGate    = 'course_delete';
                $crudRoutePart = 'courses';

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
            $table->editColumn('associated_processes', function ($row) {
                $labels = [];

                foreach ($row->associated_processes as $associated_process) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $associated_process->name);
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
            $table->editColumn('roles', function ($row) {
                $labels = [];

                foreach ($row->roles as $role) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $role->title);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('focalizacion_territorial', function ($row) {
                $labels = [];

                foreach ($row->focalizacion_territorials as $focalizacion_territorial) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $focalizacion_territorial->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('support_required', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->support_required ? 'checked' : null) . '>';
            });
            $table->editColumn('hours', function ($row) {
                return $row->hours ? $row->hours : "";
            });
            $table->editColumn('operators', function ($row) {
                $labels = [];

                foreach ($row->operators as $operator) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $operator->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('references', function ($row) {
                $labels = [];

                foreach ($row->references as $reference) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $reference->title);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('courseshooks', function ($row) {
                $labels = [];

                foreach ($row->courseshooks as $courseshook) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $courseshook->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'associated_processes', 'roles', 'focalizacion_territorial', 'support_required', 'operators', 'references', 'courseshooks']);

            return $table->make(true);
        }

        $background_processes = BackgroundProcess::get();
        $roles                = Role::get();
        $departments          = Department::get();
        $operators            = Operator::get();
        $reference_objects    = ReferenceObject::get();
        $courses_hooks        = CoursesHook::get();

        return view('admin.courses.index', compact('background_processes', 'roles', 'departments', 'operators', 'reference_objects', 'courses_hooks'));
    }

    public function create()
    {
        abort_if(Gate::denies('course_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $associated_processes = BackgroundProcess::all()->pluck('name', 'id');

        $roles = Role::all()->pluck('title', 'id');

        $focalizacion_territorials = Department::all()->pluck('name', 'id');

        $operators = Operator::all()->pluck('name', 'id');

        $references = ReferenceObject::all()->pluck('title', 'id');

        $courseshooks = CoursesHook::all()->pluck('name', 'id');

        return view('admin.courses.create', compact('associated_processes', 'roles', 'focalizacion_territorials', 'operators', 'references', 'courseshooks'));
    }

    public function store(StoreCourseRequest $request)
    {
        $course = Course::create($request->all());
        $course->associated_processes()->sync($request->input('associated_processes', []));
        $course->roles()->sync($request->input('roles', []));
        $course->focalizacion_territorials()->sync($request->input('focalizacion_territorials', []));
        $course->operators()->sync($request->input('operators', []));
        $course->references()->sync($request->input('references', []));
        $course->courseshooks()->sync($request->input('courseshooks', []));

        return redirect()->route('admin.courses.index');
    }

    public function edit(Course $course)
    {
        abort_if(Gate::denies('course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $associated_processes = BackgroundProcess::all()->pluck('name', 'id');

        $roles = Role::all()->pluck('title', 'id');

        $focalizacion_territorials = Department::all()->pluck('name', 'id');

        $operators = Operator::all()->pluck('name', 'id');

        $references = ReferenceObject::all()->pluck('title', 'id');

        $courseshooks = CoursesHook::all()->pluck('name', 'id');

        $course->load('associated_processes', 'roles', 'focalizacion_territorials', 'operators', 'references', 'courseshooks');

        return view('admin.courses.edit', compact('associated_processes', 'roles', 'focalizacion_territorials', 'operators', 'references', 'courseshooks', 'course'));
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->all());
        $course->associated_processes()->sync($request->input('associated_processes', []));
        $course->roles()->sync($request->input('roles', []));
        $course->focalizacion_territorials()->sync($request->input('focalizacion_territorials', []));
        $course->operators()->sync($request->input('operators', []));
        $course->references()->sync($request->input('references', []));
        $course->courseshooks()->sync($request->input('courseshooks', []));

        return redirect()->route('admin.courses.index');
    }

    public function show(Course $course)
    {
        abort_if(Gate::denies('course_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course->load('associated_processes', 'roles', 'focalizacion_territorials', 'operators', 'references', 'courseshooks', 'coursesChallenges');

        return view('admin.courses.show', compact('course'));
    }

    public function destroy(Course $course)
    {
        abort_if(Gate::denies('course_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course->delete();

        return back();
    }

    public function massDestroy(MassDestroyCourseRequest $request)
    {
        Course::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
