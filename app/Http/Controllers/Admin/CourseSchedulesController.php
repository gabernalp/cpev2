<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCourseScheduleRequest;
use App\Http\Requests\StoreCourseScheduleRequest;
use App\Http\Requests\UpdateCourseScheduleRequest;
use App\Models\Course;
use App\Models\CourseSchedule;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseSchedulesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('course_schedule_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseSchedules = CourseSchedule::with(['course', 'tutors', 'created_by'])->get();

        return view('admin.courseSchedules.index', compact('courseSchedules'));
    }

    public function create()
    {
        abort_if(Gate::denies('course_schedule_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tutors = User::all()->pluck('name', 'id');

        return view('admin.courseSchedules.create', compact('courses', 'tutors'));
    }

    public function store(StoreCourseScheduleRequest $request)
    {
        $courseSchedule = CourseSchedule::create($request->all());
        $courseSchedule->tutors()->sync($request->input('tutors', []));

        return redirect()->route('admin.course-schedules.index');
    }

    public function edit(CourseSchedule $courseSchedule)
    {
        abort_if(Gate::denies('course_schedule_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tutors = User::all()->pluck('name', 'id');

        $courseSchedule->load('course', 'tutors', 'created_by');

        return view('admin.courseSchedules.edit', compact('courses', 'tutors', 'courseSchedule'));
    }

    public function update(UpdateCourseScheduleRequest $request, CourseSchedule $courseSchedule)
    {
        $courseSchedule->update($request->all());
        $courseSchedule->tutors()->sync($request->input('tutors', []));

        return redirect()->route('admin.course-schedules.index');
    }

    public function show(CourseSchedule $courseSchedule)
    {
        abort_if(Gate::denies('course_schedule_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseSchedule->load('course', 'tutors', 'created_by');

        return view('admin.courseSchedules.show', compact('courseSchedule'));
    }

    public function destroy(CourseSchedule $courseSchedule)
    {
        abort_if(Gate::denies('course_schedule_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseSchedule->delete();

        return back();
    }

    public function massDestroy(MassDestroyCourseScheduleRequest $request)
    {
        CourseSchedule::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
