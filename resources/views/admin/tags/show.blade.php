@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.tag.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tags.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.tag.fields.id') }}
                        </th>
                        <td>
                            {{ $tag->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tag.fields.name') }}
                        </th>
                        <td>
                            {{ $tag->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tags.index') }}">
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
            <a class="nav-link" href="#tags_background_processes" role="tab" data-toggle="tab">
                {{ trans('cruds.backgroundProcess.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#tags_reference_objects" role="tab" data-toggle="tab">
                {{ trans('cruds.referenceObject.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="tags_background_processes">
            @includeIf('admin.tags.relationships.tagsBackgroundProcesses', ['backgroundProcesses' => $tag->tagsBackgroundProcesses])
        </div>
        <div class="tab-pane" role="tabpanel" id="tags_reference_objects">
            @includeIf('admin.tags.relationships.tagsReferenceObjects', ['referenceObjects' => $tag->tagsReferenceObjects])
        </div>
    </div>
</div>

@endsection