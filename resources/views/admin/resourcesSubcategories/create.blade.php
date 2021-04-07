@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.resourcesSubcategory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.resources-subcategories.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="resourcescategory_id">{{ trans('cruds.resourcesSubcategory.fields.resourcescategory') }}</label>
                <select class="form-control select2 {{ $errors->has('resourcescategory') ? 'is-invalid' : '' }}" name="resourcescategory_id" id="resourcescategory_id">
                    @foreach($resourcescategories as $id => $resourcescategory)
                        <option value="{{ $id }}" {{ old('resourcescategory_id') == $id ? 'selected' : '' }}>{{ $resourcescategory }}</option>
                    @endforeach
                </select>
                @if($errors->has('resourcescategory'))
                    <div class="invalid-feedback">
                        {{ $errors->first('resourcescategory') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.resourcesSubcategory.fields.resourcescategory_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name">{{ trans('cruds.resourcesSubcategory.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.resourcesSubcategory.fields.name_helper') }}</span>
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