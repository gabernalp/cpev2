@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.resourcesAudit.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.resources-audits.update", [$resourcesAudit->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="recurso_id">{{ trans('cruds.resourcesAudit.fields.recurso') }}</label>
                <select class="form-control select2 {{ $errors->has('recurso') ? 'is-invalid' : '' }}" name="recurso_id" id="recurso_id">
                    @foreach($recursos as $id => $recurso)
                        <option value="{{ $id }}" {{ (old('recurso_id') ? old('recurso_id') : $resourcesAudit->recurso->id ?? '') == $id ? 'selected' : '' }}>{{ $recurso }}</option>
                    @endforeach
                </select>
                @if($errors->has('recurso'))
                    <div class="invalid-feedback">
                        {{ $errors->first('recurso') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.resourcesAudit.fields.recurso_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ip">{{ trans('cruds.resourcesAudit.fields.ip') }}</label>
                <input class="form-control {{ $errors->has('ip') ? 'is-invalid' : '' }}" type="text" name="ip" id="ip" value="{{ old('ip', $resourcesAudit->ip) }}">
                @if($errors->has('ip'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ip') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.resourcesAudit.fields.ip_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.resourcesAudit.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $resourcesAudit->user->id ?? '') == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.resourcesAudit.fields.user_helper') }}</span>
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