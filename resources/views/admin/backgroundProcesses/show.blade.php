@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.backgroundProcess.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.background-processes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.backgroundProcess.fields.id') }}
                        </th>
                        <td>
                            {{ $backgroundProcess->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.backgroundProcess.fields.name') }}
                        </th>
                        <td>
                            {{ $backgroundProcess->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.backgroundProcess.fields.description') }}
                        </th>
                        <td>
                            {{ $backgroundProcess->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.backgroundProcess.fields.tags') }}
                        </th>
                        <td>
                            @foreach($backgroundProcess->tags as $key => $tags)
                                <span class="label label-info">{{ $tags->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.backgroundProcess.fields.file') }}
                        </th>
                        <td>
                            @foreach($backgroundProcess->file as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.backgroundProcess.fields.images') }}
                        </th>
                        <td>
                            @foreach($backgroundProcess->images as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.backgroundProcess.fields.comments') }}
                        </th>
                        <td>
                            {{ $backgroundProcess->comments }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.background-processes.index') }}">
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
            <a class="nav-link" href="#associated_processes_courses" role="tab" data-toggle="tab">
                {{ trans('cruds.course.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="associated_processes_courses">
            @includeIf('admin.backgroundProcesses.relationships.associatedProcessesCourses', ['courses' => $backgroundProcess->associatedProcessesCourses])
        </div>
    </div>
</div>

@endsection