@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.referenceObject.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.reference-objects.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.referenceObject.fields.id') }}
                        </th>
                        <td>
                            {{ $referenceObject->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.referenceObject.fields.referencetype') }}
                        </th>
                        <td>
                            {{ $referenceObject->referencetype->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.referenceObject.fields.title') }}
                        </th>
                        <td>
                            {{ $referenceObject->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.referenceObject.fields.link') }}
                        </th>
                        <td>
                            {{ $referenceObject->link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.referenceObject.fields.file') }}
                        </th>
                        <td>
                            @if($referenceObject->file)
                                <a href="{{ $referenceObject->file->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.referenceObject.fields.image') }}
                        </th>
                        <td>
                            {{ $referenceObject->image }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.referenceObject.fields.tags') }}
                        </th>
                        <td>
                            @foreach($referenceObject->tags as $key => $tags)
                                <span class="label label-info">{{ $tags->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.referenceObject.fields.comments') }}
                        </th>
                        <td>
                            {{ $referenceObject->comments }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.reference-objects.index') }}">
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
            <a class="nav-link" href="#references_courses" role="tab" data-toggle="tab">
                {{ trans('cruds.course.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="references_courses">
            @includeIf('admin.referenceObjects.relationships.referencesCourses', ['courses' => $referenceObject->referencesCourses])
        </div>
    </div>
</div>

@endsection