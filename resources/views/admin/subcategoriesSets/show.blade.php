@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.subcategoriesSet.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.subcategories-sets.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.subcategoriesSet.fields.id') }}
                        </th>
                        <td>
                            {{ $subcategoriesSet->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subcategoriesSet.fields.resourcescategory') }}
                        </th>
                        <td>
                            {{ $subcategoriesSet->resourcescategory->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subcategoriesSet.fields.resourcessubcategory') }}
                        </th>
                        <td>
                            {{ $subcategoriesSet->resourcessubcategory->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subcategoriesSet.fields.name') }}
                        </th>
                        <td>
                            {{ $subcategoriesSet->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.subcategories-sets.index') }}">
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
            <a class="nav-link" href="#subcategoriesset_resources" role="tab" data-toggle="tab">
                {{ trans('cruds.resource.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="subcategoriesset_resources">
            @includeIf('admin.subcategoriesSets.relationships.subcategoriessetResources', ['resources' => $subcategoriesSet->subcategoriessetResources])
        </div>
    </div>
</div>

@endsection