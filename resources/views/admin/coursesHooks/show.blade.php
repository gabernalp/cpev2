@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.coursesHook.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.courses-hooks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.coursesHook.fields.id') }}
                        </th>
                        <td>
                            {{ $coursesHook->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coursesHook.fields.name') }}
                        </th>
                        <td>
                            {{ $coursesHook->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coursesHook.fields.description') }}
                        </th>
                        <td>
                            {{ $coursesHook->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coursesHook.fields.specific_category') }}
                        </th>
                        <td>
                            {{ $coursesHook->specific_category }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coursesHook.fields.entity') }}
                        </th>
                        <td>
                            @foreach($coursesHook->entities as $key => $entity)
                                <span class="label label-info">{{ $entity->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coursesHook.fields.department') }}
                        </th>
                        <td>
                            @foreach($coursesHook->departments as $key => $department)
                                <span class="label label-info">{{ $department->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coursesHook.fields.requirements') }}
                        </th>
                        <td>
                            {{ $coursesHook->requirements }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coursesHook.fields.link') }}
                        </th>
                        <td>
                            {{ $coursesHook->link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coursesHook.fields.priorized') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $coursesHook->priorized ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coursesHook.fields.exclusive') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $coursesHook->exclusive ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coursesHook.fields.educational_level_exclusive') }}
                        </th>
                        <td>
                            {{ App\Models\CoursesHook::EDUCATIONAL_LEVEL_EXCLUSIVE_SELECT[$coursesHook->educational_level_exclusive] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coursesHook.fields.community') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $coursesHook->community ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coursesHook.fields.institutional') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $coursesHook->institutional ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coursesHook.fields.family') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $coursesHook->family ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coursesHook.fields.intercultural') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $coursesHook->intercultural ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coursesHook.fields.coordinator') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $coursesHook->coordinator ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coursesHook.fields.educational_group') }}
                        </th>
                        <td>
                            {{ App\Models\CoursesHook::EDUCATIONAL_GROUP_SELECT[$coursesHook->educational_group] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coursesHook.fields.educational_level') }}
                        </th>
                        <td>
                            {{ App\Models\CoursesHook::EDUCATIONAL_LEVEL_SELECT[$coursesHook->educational_level] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coursesHook.fields.file') }}
                        </th>
                        <td>
                            @if($coursesHook->file)
                                <a href="{{ $coursesHook->file->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.courses-hooks.index') }}">
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
            <a class="nav-link" href="#courseshooks_courses" role="tab" data-toggle="tab">
                {{ trans('cruds.course.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#courseshooks_self_interested_users" role="tab" data-toggle="tab">
                {{ trans('cruds.selfInterestedUser.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="courseshooks_courses">
            @includeIf('admin.coursesHooks.relationships.courseshooksCourses', ['courses' => $coursesHook->courseshooksCourses])
        </div>
        <div class="tab-pane" role="tabpanel" id="courseshooks_self_interested_users">
            @includeIf('admin.coursesHooks.relationships.courseshooksSelfInterestedUsers', ['selfInterestedUsers' => $coursesHook->courseshooksSelfInterestedUsers])
        </div>
    </div>
</div>

@endsection