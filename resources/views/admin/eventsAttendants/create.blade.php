@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.eventsAttendant.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.events-attendants.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.eventsAttendant.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.eventsAttendant.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="last_name">{{ trans('cruds.eventsAttendant.fields.last_name') }}</label>
                <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', '') }}" required>
                @if($errors->has('last_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('last_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.eventsAttendant.fields.last_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="documenttype">{{ trans('cruds.eventsAttendant.fields.documenttype') }}</label>
                <input class="form-control {{ $errors->has('documenttype') ? 'is-invalid' : '' }}" type="text" name="documenttype" id="documenttype" value="{{ old('documenttype', '') }}" required>
                @if($errors->has('documenttype'))
                    <div class="invalid-feedback">
                        {{ $errors->first('documenttype') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.eventsAttendant.fields.documenttype_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="document">{{ trans('cruds.eventsAttendant.fields.document') }}</label>
                <input class="form-control {{ $errors->has('document') ? 'is-invalid' : '' }}" type="text" name="document" id="document" value="{{ old('document', '') }}" required>
                @if($errors->has('document'))
                    <div class="invalid-feedback">
                        {{ $errors->first('document') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.eventsAttendant.fields.document_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="department_id">{{ trans('cruds.eventsAttendant.fields.department') }}</label>
                <select class="form-control select2 {{ $errors->has('department') ? 'is-invalid' : '' }}" name="department_id" id="department_id" required>
                    @foreach($departments as $id => $department)
                        <option value="{{ $id }}" {{ old('department_id') == $id ? 'selected' : '' }}>{{ $department }}</option>
                    @endforeach
                </select>
                @if($errors->has('department'))
                    <div class="invalid-feedback">
                        {{ $errors->first('department') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.eventsAttendant.fields.department_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="city_id">{{ trans('cruds.eventsAttendant.fields.city') }}</label>
                <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id">
                    @foreach($cities as $id => $city)
                        <option value="{{ $id }}" {{ old('city_id') == $id ? 'selected' : '' }}>{{ $city }}</option>
                    @endforeach
                </select>
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.eventsAttendant.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.eventsAttendant.fields.entity') }}</label>
                <select class="form-control {{ $errors->has('entity') ? 'is-invalid' : '' }}" name="entity" id="entity">
                    <option value disabled {{ old('entity', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\EventsAttendant::ENTITY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('entity', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('entity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('entity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.eventsAttendant.fields.entity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('cruds.eventsAttendant.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}">
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.eventsAttendant.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.eventsAttendant.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', '') }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.eventsAttendant.fields.email_helper') }}</span>
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