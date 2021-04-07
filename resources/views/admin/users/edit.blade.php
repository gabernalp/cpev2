@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.user.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.users.update", [$user->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="documenttype_id">{{ trans('cruds.user.fields.documenttype') }}</label>
                <select class="form-control select2 {{ $errors->has('documenttype') ? 'is-invalid' : '' }}" name="documenttype_id" id="documenttype_id">
                    @foreach($documenttypes as $id => $documenttype)
                        <option value="{{ $id }}" {{ (old('documenttype_id') ? old('documenttype_id') : $user->documenttype->id ?? '') == $id ? 'selected' : '' }}>{{ $documenttype }}</option>
                    @endforeach
                </select>
                @if($errors->has('documenttype'))
                    <div class="invalid-feedback">
                        {{ $errors->first('documenttype') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.documenttype_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="document">{{ trans('cruds.user.fields.document') }}</label>
                <input class="form-control {{ $errors->has('document') ? 'is-invalid' : '' }}" type="number" name="document" id="document" value="{{ old('document', $user->document) }}" step="1" required>
                @if($errors->has('document'))
                    <div class="invalid-feedback">
                        {{ $errors->first('document') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.document_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="last_name">{{ trans('cruds.user.fields.last_name') }}</label>
                <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->last_name) }}" required>
                @if($errors->has('last_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('last_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.last_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.user.fields.gender') }}</label>
                <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender">
                    <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\User::GENDER_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('gender', $user->gender) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('gender'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gender') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.gender_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone">{{ trans('cruds.user.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" required>
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone_2">{{ trans('cruds.user.fields.phone_2') }}</label>
                <input class="form-control {{ $errors->has('phone_2') ? 'is-invalid' : '' }}" type="text" name="phone_2" id="phone_2" value="{{ old('phone_2', $user->phone_2) }}">
                @if($errors->has('phone_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.phone_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="department_id">{{ trans('cruds.user.fields.department') }}</label>
                <select class="form-control select2 {{ $errors->has('department') ? 'is-invalid' : '' }}" name="department_id" id="department_id">
                    @foreach($departments as $id => $department)
                        <option value="{{ $id }}" {{ (old('department_id') ? old('department_id') : $user->department->id ?? '') == $id ? 'selected' : '' }}>{{ $department }}</option>
                    @endforeach
                </select>
                @if($errors->has('department'))
                    <div class="invalid-feedback">
                        {{ $errors->first('department') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.department_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="city_id">{{ trans('cruds.user.fields.city') }}</label>
                <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id">
                    @foreach($cities as $id => $city)
                        <option value="{{ $id }}" {{ (old('city_id') ? old('city_id') : $user->city->id ?? '') == $id ? 'selected' : '' }}>{{ $city }}</option>
                    @endforeach
                </select>
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.user.fields.zona') }}</label>
                <select class="form-control {{ $errors->has('zona') ? 'is-invalid' : '' }}" name="zona" id="zona">
                    <option value disabled {{ old('zona', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\User::ZONA_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('zona', $user->zona) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('zona'))
                    <div class="invalid-feedback">
                        {{ $errors->first('zona') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.zona_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.user.fields.etnia') }}</label>
                <select class="form-control {{ $errors->has('etnia') ? 'is-invalid' : '' }}" name="etnia" id="etnia">
                    <option value disabled {{ old('etnia', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\User::ETNIA_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('etnia', $user->etnia) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('etnia'))
                    <div class="invalid-feedback">
                        {{ $errors->first('etnia') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.etnia_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.user.fields.academic_background') }}</label>
                <select class="form-control {{ $errors->has('academic_background') ? 'is-invalid' : '' }}" name="academic_background" id="academic_background">
                    <option value disabled {{ old('academic_background', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\User::ACADEMIC_BACKGROUND_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('academic_background', $user->academic_background) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('academic_background'))
                    <div class="invalid-feedback">
                        {{ $errors->first('academic_background') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.academic_background_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="devices">{{ trans('cruds.user.fields.devices') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('devices') ? 'is-invalid' : '' }}" name="devices[]" id="devices" multiple>
                    @foreach($devices as $id => $devices)
                        <option value="{{ $id }}" {{ (in_array($id, old('devices', [])) || $user->devices->contains($id)) ? 'selected' : '' }}>{{ $devices }}</option>
                    @endforeach
                </select>
                @if($errors->has('devices'))
                    <div class="invalid-feedback">
                        {{ $errors->first('devices') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.devices_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" multiple required>
                    @foreach($roles as $id => $roles)
                        <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || $user->roles->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                    @endforeach
                </select>
                @if($errors->has('roles'))
                    <div class="invalid-feedback">
                        {{ $errors->first('roles') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.user.fields.place_role') }}</label>
                <select class="form-control {{ $errors->has('place_role') ? 'is-invalid' : '' }}" name="place_role" id="place_role">
                    <option value disabled {{ old('place_role', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\User::PLACE_ROLE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('place_role', $user->place_role) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('place_role'))
                    <div class="invalid-feedback">
                        {{ $errors->first('place_role') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.place_role_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.user.fields.labour_role') }}</label>
                <select class="form-control {{ $errors->has('labour_role') ? 'is-invalid' : '' }}" name="labour_role" id="labour_role">
                    <option value disabled {{ old('labour_role', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\User::LABOUR_ROLE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('labour_role', $user->labour_role) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('labour_role'))
                    <div class="invalid-feedback">
                        {{ $errors->first('labour_role') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.labour_role_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.user.fields.modality') }}</label>
                <select class="form-control {{ $errors->has('modality') ? 'is-invalid' : '' }}" name="modality" id="modality">
                    <option value disabled {{ old('modality', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\User::MODALITY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('modality', $user->modality) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('modality'))
                    <div class="invalid-feedback">
                        {{ $errors->first('modality') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.modality_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="entity">{{ trans('cruds.user.fields.entity') }}</label>
                <input class="form-control {{ $errors->has('entity') ? 'is-invalid' : '' }}" type="text" name="entity" id="entity" value="{{ old('entity', $user->entity) }}">
                @if($errors->has('entity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('entity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.entity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="operator_id">{{ trans('cruds.user.fields.operator') }}</label>
                <select class="form-control select2 {{ $errors->has('operator') ? 'is-invalid' : '' }}" name="operator_id" id="operator_id">
                    @foreach($operators as $id => $operator)
                        <option value="{{ $id }}" {{ (old('operator_id') ? old('operator_id') : $user->operator->id ?? '') == $id ? 'selected' : '' }}>{{ $operator }}</option>
                    @endforeach
                </select>
                @if($errors->has('operator'))
                    <div class="invalid-feedback">
                        {{ $errors->first('operator') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.operator_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('newsletter_subscription') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="newsletter_subscription" value="0">
                    <input class="form-check-input" type="checkbox" name="newsletter_subscription" id="newsletter_subscription" value="1" {{ $user->newsletter_subscription || old('newsletter_subscription', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="newsletter_subscription">{{ trans('cruds.user.fields.newsletter_subscription') }}</label>
                </div>
                @if($errors->has('newsletter_subscription'))
                    <div class="invalid-feedback">
                        {{ $errors->first('newsletter_subscription') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.newsletter_subscription_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="motivation">{{ trans('cruds.user.fields.motivation') }}</label>
                <textarea class="form-control {{ $errors->has('motivation') ? 'is-invalid' : '' }}" name="motivation" id="motivation">{{ old('motivation', $user->motivation) }}</textarea>
                @if($errors->has('motivation'))
                    <div class="invalid-feedback">
                        {{ $errors->first('motivation') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.motivation_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.user.fields.experience') }}</label>
                <select class="form-control {{ $errors->has('experience') ? 'is-invalid' : '' }}" name="experience" id="experience">
                    <option value disabled {{ old('experience', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\User::EXPERIENCE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('experience', $user->experience) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('experience'))
                    <div class="invalid-feedback">
                        {{ $errors->first('experience') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.experience_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password">
                @if($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
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