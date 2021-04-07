@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.meetingAttendant.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.meeting-attendants.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="meeting_id">{{ trans('cruds.meetingAttendant.fields.meeting') }}</label>
                <select class="form-control select2 {{ $errors->has('meeting') ? 'is-invalid' : '' }}" name="meeting_id" id="meeting_id">
                    @foreach($meetings as $id => $meeting)
                        <option value="{{ $id }}" {{ old('meeting_id') == $id ? 'selected' : '' }}>{{ $meeting }}</option>
                    @endforeach
                </select>
                @if($errors->has('meeting'))
                    <div class="invalid-feedback">
                        {{ $errors->first('meeting') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.meetingAttendant.fields.meeting_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.meetingAttendant.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.meetingAttendant.fields.user_helper') }}</span>
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