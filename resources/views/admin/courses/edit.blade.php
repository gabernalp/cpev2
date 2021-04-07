@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.course.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.courses.update", [$course->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="associated_processes">{{ trans('cruds.course.fields.associated_processes') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('associated_processes') ? 'is-invalid' : '' }}" name="associated_processes[]" id="associated_processes" multiple required>
                    @foreach($associated_processes as $id => $associated_processes)
                        <option value="{{ $id }}" {{ (in_array($id, old('associated_processes', [])) || $course->associated_processes->contains($id)) ? 'selected' : '' }}>{{ $associated_processes }}</option>
                    @endforeach
                </select>
                @if($errors->has('associated_processes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('associated_processes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.course.fields.associated_processes_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.course.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $course->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.course.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="description">{{ trans('cruds.course.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" required>{{ old('description', $course->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.course.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="goal">{{ trans('cruds.course.fields.goal') }}</label>
                <textarea class="form-control {{ $errors->has('goal') ? 'is-invalid' : '' }}" name="goal" id="goal" required>{{ old('goal', $course->goal) }}</textarea>
                @if($errors->has('goal'))
                    <div class="invalid-feedback">
                        {{ $errors->first('goal') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.course.fields.goal_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="roles">{{ trans('cruds.course.fields.roles') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" multiple required>
                    @foreach($roles as $id => $roles)
                        <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || $course->roles->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                    @endforeach
                </select>
                @if($errors->has('roles'))
                    <div class="invalid-feedback">
                        {{ $errors->first('roles') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.course.fields.roles_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="focalizacion_territorials">{{ trans('cruds.course.fields.focalizacion_territorial') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('focalizacion_territorials') ? 'is-invalid' : '' }}" name="focalizacion_territorials[]" id="focalizacion_territorials" multiple required>
                    @foreach($focalizacion_territorials as $id => $focalizacion_territorial)
                        <option value="{{ $id }}" {{ (in_array($id, old('focalizacion_territorials', [])) || $course->focalizacion_territorials->contains($id)) ? 'selected' : '' }}>{{ $focalizacion_territorial }}</option>
                    @endforeach
                </select>
                @if($errors->has('focalizacion_territorials'))
                    <div class="invalid-feedback">
                        {{ $errors->first('focalizacion_territorials') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.course.fields.focalizacion_territorial_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('support_required') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="support_required" value="0">
                    <input class="form-check-input" type="checkbox" name="support_required" id="support_required" value="1" {{ $course->support_required || old('support_required', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="support_required">{{ trans('cruds.course.fields.support_required') }}</label>
                </div>
                @if($errors->has('support_required'))
                    <div class="invalid-feedback">
                        {{ $errors->first('support_required') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.course.fields.support_required_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hours">{{ trans('cruds.course.fields.hours') }}</label>
                <input class="form-control {{ $errors->has('hours') ? 'is-invalid' : '' }}" type="text" name="hours" id="hours" value="{{ old('hours', $course->hours) }}">
                @if($errors->has('hours'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hours') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.course.fields.hours_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="operators">{{ trans('cruds.course.fields.operators') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('operators') ? 'is-invalid' : '' }}" name="operators[]" id="operators" multiple>
                    @foreach($operators as $id => $operators)
                        <option value="{{ $id }}" {{ (in_array($id, old('operators', [])) || $course->operators->contains($id)) ? 'selected' : '' }}>{{ $operators }}</option>
                    @endforeach
                </select>
                @if($errors->has('operators'))
                    <div class="invalid-feedback">
                        {{ $errors->first('operators') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.course.fields.operators_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="references">{{ trans('cruds.course.fields.references') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('references') ? 'is-invalid' : '' }}" name="references[]" id="references" multiple>
                    @foreach($references as $id => $references)
                        <option value="{{ $id }}" {{ (in_array($id, old('references', [])) || $course->references->contains($id)) ? 'selected' : '' }}>{{ $references }}</option>
                    @endforeach
                </select>
                @if($errors->has('references'))
                    <div class="invalid-feedback">
                        {{ $errors->first('references') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.course.fields.references_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="courseshooks">{{ trans('cruds.course.fields.courseshooks') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('courseshooks') ? 'is-invalid' : '' }}" name="courseshooks[]" id="courseshooks" multiple>
                    @foreach($courseshooks as $id => $courseshooks)
                        <option value="{{ $id }}" {{ (in_array($id, old('courseshooks', [])) || $course->courseshooks->contains($id)) ? 'selected' : '' }}>{{ $courseshooks }}</option>
                    @endforeach
                </select>
                @if($errors->has('courseshooks'))
                    <div class="invalid-feedback">
                        {{ $errors->first('courseshooks') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.course.fields.courseshooks_helper') }}</span>
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