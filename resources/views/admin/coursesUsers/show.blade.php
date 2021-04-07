@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.coursesUser.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.courses-users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.coursesUser.fields.id') }}
                        </th>
                        <td>
                            {{ $coursesUser->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coursesUser.fields.user') }}
                        </th>
                        <td>
                            {{ $coursesUser->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coursesUser.fields.course_name') }}
                        </th>
                        <td>
                            {{ $coursesUser->course_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coursesUser.fields.group') }}
                        </th>
                        <td>
                            {{ $coursesUser->group }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coursesUser.fields.start_date') }}
                        </th>
                        <td>
                            {{ $coursesUser->start_date->start_date ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coursesUser.fields.end_date') }}
                        </th>
                        <td>
                            {{ $coursesUser->end_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coursesUser.fields.challenges') }}
                        </th>
                        <td>
                            {{ $coursesUser->challenges }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coursesUser.fields.feedbacks') }}
                        </th>
                        <td>
                            {{ $coursesUser->feedbacks }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coursesUser.fields.badges') }}
                        </th>
                        <td>
                            {{ $coursesUser->badges }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.courses-users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection