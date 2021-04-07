@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.resourcesSubcategory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.resources-subcategories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.resourcesSubcategory.fields.id') }}
                        </th>
                        <td>
                            {{ $resourcesSubcategory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.resourcesSubcategory.fields.resourcescategory') }}
                        </th>
                        <td>
                            {{ $resourcesSubcategory->resourcescategory->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.resourcesSubcategory.fields.name') }}
                        </th>
                        <td>
                            {{ $resourcesSubcategory->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.resources-subcategories.index') }}">
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
            <a class="nav-link" href="#resourcessubcategory_subcategories_sets" role="tab" data-toggle="tab">
                {{ trans('cruds.subcategoriesSet.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#resourcessubcategory_resources" role="tab" data-toggle="tab">
                {{ trans('cruds.resource.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="resourcessubcategory_subcategories_sets">
            @includeIf('admin.resourcesSubcategories.relationships.resourcessubcategorySubcategoriesSets', ['subcategoriesSets' => $resourcesSubcategory->resourcessubcategorySubcategoriesSets])
        </div>
        <div class="tab-pane" role="tabpanel" id="resourcessubcategory_resources">
            @includeIf('admin.resourcesSubcategories.relationships.resourcessubcategoryResources', ['resources' => $resourcesSubcategory->resourcessubcategoryResources])
        </div>
    </div>
</div>

@endsection