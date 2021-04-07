@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.referenceType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.reference-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.referenceType.fields.id') }}
                        </th>
                        <td>
                            {{ $referenceType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.referenceType.fields.name') }}
                        </th>
                        <td>
                            {{ $referenceType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.referenceType.fields.code') }}
                        </th>
                        <td>
                            {{ $referenceType->code }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.reference-types.index') }}">
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
            <a class="nav-link" href="#referencetype_reference_objects" role="tab" data-toggle="tab">
                {{ trans('cruds.referenceObject.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="referencetype_reference_objects">
            @includeIf('admin.referenceTypes.relationships.referencetypeReferenceObjects', ['referenceObjects' => $referenceType->referencetypeReferenceObjects])
        </div>
    </div>
</div>

@endsection