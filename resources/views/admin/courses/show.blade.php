@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.course.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.courses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.id') }}
                        </th>
                        <td>
                            {{ $course->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.associated_processes') }}
                        </th>
                        <td>
                            @foreach($course->associated_processes as $key => $associated_processes)
                                <span class="label label-info">{{ $associated_processes->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.name') }}
                        </th>
                        <td>
                            {{ $course->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.description') }}
                        </th>
                        <td>
                            {{ $course->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.goal') }}
                        </th>
                        <td>
                            {{ $course->goal }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.roles') }}
                        </th>
                        <td>
                            @foreach($course->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.focalizacion_territorial') }}
                        </th>
                        <td>
                            @foreach($course->focalizacion_territorials as $key => $focalizacion_territorial)
                                <span class="label label-info">{{ $focalizacion_territorial->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.support_required') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $course->support_required ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.hours') }}
                        </th>
                        <td>
                            {{ $course->hours }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.operators') }}
                        </th>
                        <td>
                            @foreach($course->operators as $key => $operators)
                                <span class="label label-info">{{ $operators->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.references') }}
                        </th>
                        <td>
                            @foreach($course->references as $key => $references)
                                <span class="label label-info">{{ $references->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.courseshooks') }}
                        </th>
                        <td>
                            @foreach($course->courseshooks as $key => $courseshooks)
                                <span class="label label-info">{{ $courseshooks->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.courses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#courses_challenges" role="tab" data-toggle="tab">
                {{ trans('cruds.challenge.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="courses_challenges">
            @includeIf('admin.courses.relationships.coursesChallenges', ['challenges' => $course->coursesChallenges])
        </div>
    </div>
</div>

@endsection