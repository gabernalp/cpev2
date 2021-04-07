@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.courseSchedule.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.course-schedules.update", [$courseSchedule->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="course_id">{{ trans('cruds.courseSchedule.fields.course') }}</label>
                <select class="form-control select2 {{ $errors->has('course') ? 'is-invalid' : '' }}" name="course_id" id="course_id" required>
                    @foreach($courses as $id => $course)
                        <option value="{{ $id }}" {{ (old('course_id') ? old('course_id') : $courseSchedule->course->id ?? '') == $id ? 'selected' : '' }}>{{ $course }}</option>
                    @endforeach
                </select>
                @if($errors->has('course'))
                    <div class="invalid-feedback">
                        {{ $errors->first('course') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.courseSchedule.fields.course_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_date">{{ trans('cruds.courseSchedule.fields.start_date') }}</label>
                <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="start_date" value="{{ old('start_date', $courseSchedule->start_date) }}" required>
                @if($errors->has('start_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.courseSchedule.fields.start_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tutors">{{ trans('cruds.courseSchedule.fields.tutors') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('tutors') ? 'is-invalid' : '' }}" name="tutors[]" id="tutors" multiple required>
                    @foreach($tutors as $id => $tutors)
                        <option value="{{ $id }}" {{ (in_array($id, old('tutors', [])) || $courseSchedule->tutors->contains($id)) ? 'selected' : '' }}>{{ $tutors }}</option>
                    @endforeach
                </select>
                @if($errors->has('tutors'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tutors') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.courseSchedule.fields.tutors_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tutor_capacity">{{ trans('cruds.courseSchedule.fields.tutor_capacity') }}</label>
                <input class="form-control {{ $errors->has('tutor_capacity') ? 'is-invalid' : '' }}" type="number" name="tutor_capacity" id="tutor_capacity" value="{{ old('tutor_capacity', $courseSchedule->tutor_capacity) }}" step="1" required>
                @if($errors->has('tutor_capacity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tutor_capacity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.courseSchedule.fields.tutor_capacity_helper') }}</span>
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