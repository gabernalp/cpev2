@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.subcategoriesSet.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.subcategories-sets.update", [$subcategoriesSet->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="resourcescategory_id">{{ trans('cruds.subcategoriesSet.fields.resourcescategory') }}</label>
                <select class="form-control select2 {{ $errors->has('resourcescategory') ? 'is-invalid' : '' }}" name="resourcescategory_id" id="resourcescategory_id">
                    @foreach($resourcescategories as $id => $resourcescategory)
                        <option value="{{ $id }}" {{ (old('resourcescategory_id') ? old('resourcescategory_id') : $subcategoriesSet->resourcescategory->id ?? '') == $id ? 'selected' : '' }}>{{ $resourcescategory }}</option>
                    @endforeach
                </select>
                @if($errors->has('resourcescategory'))
                    <div class="invalid-feedback">
                        {{ $errors->first('resourcescategory') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.subcategoriesSet.fields.resourcescategory_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="resourcessubcategory_id">{{ trans('cruds.subcategoriesSet.fields.resourcessubcategory') }}</label>
                <select class="form-control select2 {{ $errors->has('resourcessubcategory') ? 'is-invalid' : '' }}" name="resourcessubcategory_id" id="resourcessubcategory_id">
                    @foreach($resourcessubcategories as $id => $resourcessubcategory)
                        <option value="{{ $id }}" {{ (old('resourcessubcategory_id') ? old('resourcessubcategory_id') : $subcategoriesSet->resourcessubcategory->id ?? '') == $id ? 'selected' : '' }}>{{ $resourcessubcategory }}</option>
                    @endforeach
                </select>
                @if($errors->has('resourcessubcategory'))
                    <div class="invalid-feedback">
                        {{ $errors->first('resourcessubcategory') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.subcategoriesSet.fields.resourcessubcategory_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name">{{ trans('cruds.subcategoriesSet.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $subcategoriesSet->name) }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.subcategoriesSet.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection