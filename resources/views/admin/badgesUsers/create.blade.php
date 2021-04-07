@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.badgesUser.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.badges-users.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.badgesUser.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.badgesUser.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="badge_id">{{ trans('cruds.badgesUser.fields.badge') }}</label>
                <select class="form-control select2 {{ $errors->has('badge') ? 'is-invalid' : '' }}" name="badge_id" id="badge_id" required>
                    @foreach($badges as $id => $badge)
                        <option value="{{ $id }}" {{ old('badge_id') == $id ? 'selected' : '' }}>{{ $badge }}</option>
                    @endforeach
                </select>
                @if($errors->has('badge'))
                    <div class="invalid-feedback">
                        {{ $errors->first('badge') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.badgesUser.fields.badge_helper') }}</span>
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