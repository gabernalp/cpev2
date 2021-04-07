@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.courseSchedule.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.course-schedules.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.courseSchedule.fields.id') }}
                        </th>
                        <td>
                            {{ $courseSchedule->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseSchedule.fields.course') }}
                        </th>
                        <td>
                            {{ $courseSchedule->course->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseSchedule.fields.start_date') }}
                        </th>
                        <td>
                            {{ $courseSchedule->start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseSchedule.fields.tutors') }}
                        </th>
                        <td>
                            @foreach($courseSchedule->tutors as $key => $tutors)
                                <span class="label label-info">{{ $tutors->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseSchedule.fields.tutor_capacity') }}
                        </th>
                        <td>
                            {{ $courseSchedule->tutor_capacity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseSchedule.fields.iterations_number') }}
                        </th>
                        <td>
                            {{ $courseSchedule->iterations_number }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.course-schedules.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection