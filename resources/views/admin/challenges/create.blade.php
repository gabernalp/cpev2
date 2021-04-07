@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.challenge.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.challenges.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="courses">{{ trans('cruds.challenge.fields.courses') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('courses') ? 'is-invalid' : '' }}" name="courses[]" id="courses" multiple>
                    @foreach($courses as $id => $courses)
                        <option value="{{ $id }}" {{ in_array($id, old('courses', [])) ? 'selected' : '' }}>{{ $courses }}</option>
                    @endforeach
                </select>
                @if($errors->has('courses'))
                    <div class="invalid-feedback">
                        {{ $errors->first('courses') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.challenge.fields.courses_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.challenge.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.challenge.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.challenge.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', '') }}">
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.challenge.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="goal">{{ trans('cruds.challenge.fields.goal') }}</label>
                <textarea class="form-control {{ $errors->has('goal') ? 'is-invalid' : '' }}" name="goal" id="goal">{{ old('goal') }}</textarea>
                @if($errors->has('goal'))
                    <div class="invalid-feedback">
                        {{ $errors->first('goal') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.challenge.fields.goal_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="capsule">{{ trans('cruds.challenge.fields.capsule') }}</label>
                <input class="form-control {{ $errors->has('capsule') ? 'is-invalid' : '' }}" type="text" name="capsule" id="capsule" value="{{ old('capsule', '') }}">
                @if($errors->has('capsule'))
                    <div class="invalid-feedback">
                        {{ $errors->first('capsule') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.challenge.fields.capsule_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="capsule_content">{{ trans('cruds.challenge.fields.capsule_content') }}</label>
                <textarea class="form-control {{ $errors->has('capsule_content') ? 'is-invalid' : '' }}" name="capsule_content" id="capsule_content">{{ old('capsule_content') }}</textarea>
                @if($errors->has('capsule_content'))
                    <div class="invalid-feedback">
                        {{ $errors->first('capsule_content') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.challenge.fields.capsule_content_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="capsule_file">{{ trans('cruds.challenge.fields.capsule_file') }}</label>
                <div class="needsclick dropzone {{ $errors->has('capsule_file') ? 'is-invalid' : '' }}" id="capsule_file-dropzone">
                </div>
                @if($errors->has('capsule_file'))
                    <div class="invalid-feedback">
                        {{ $errors->first('capsule_file') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.challenge.fields.capsule_file_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.challenge.fields.challenge_action') }}</label>
                <select class="form-control {{ $errors->has('challenge_action') ? 'is-invalid' : '' }}" name="challenge_action" id="challenge_action">
                    <option value disabled {{ old('challenge_action', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Challenge::CHALLENGE_ACTION_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('challenge_action', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('challenge_action'))
                    <div class="invalid-feedback">
                        {{ $errors->first('challenge_action') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.challenge.fields.challenge_action_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="action_detail">{{ trans('cruds.challenge.fields.action_detail') }}</label>
                <textarea class="form-control {{ $errors->has('action_detail') ? 'is-invalid' : '' }}" name="action_detail" id="action_detail">{{ old('action_detail') }}</textarea>
                @if($errors->has('action_detail'))
                    <div class="invalid-feedback">
                        {{ $errors->first('action_detail') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.challenge.fields.action_detail_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.challenge.fields.limit_time') }}</label>
                <select class="form-control {{ $errors->has('limit_time') ? 'is-invalid' : '' }}" name="limit_time" id="limit_time">
                    <option value disabled {{ old('limit_time', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Challenge::LIMIT_TIME_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('limit_time', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('limit_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('limit_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.challenge.fields.limit_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="referencetype_id">{{ trans('cruds.challenge.fields.referencetype') }}</label>
                <select class="form-control select2 {{ $errors->has('referencetype') ? 'is-invalid' : '' }}" name="referencetype_id" id="referencetype_id" required>
                    @foreach($referencetypes as $id => $referencetype)
                        <option value="{{ $id }}" {{ old('referencetype_id') == $id ? 'selected' : '' }}>{{ $referencetype }}</option>
                    @endforeach
                </select>
                @if($errors->has('referencetype'))
                    <div class="invalid-feedback">
                        {{ $errors->first('referencetype') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.challenge.fields.referencetype_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="hours_adding">{{ trans('cruds.challenge.fields.hours_adding') }}</label>
                <input class="form-control {{ $errors->has('hours_adding') ? 'is-invalid' : '' }}" type="number" name="hours_adding" id="hours_adding" value="{{ old('hours_adding', '') }}" step="1" required>
                @if($errors->has('hours_adding'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hours_adding') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.challenge.fields.hours_adding_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="points">{{ trans('cruds.challenge.fields.points') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('points') ? 'is-invalid' : '' }}" name="points[]" id="points" multiple>
                    @foreach($points as $id => $points)
                        <option value="{{ $id }}" {{ in_array($id, old('points', [])) ? 'selected' : '' }}>{{ $points }}</option>
                    @endforeach
                </select>
                @if($errors->has('points'))
                    <div class="invalid-feedback">
                        {{ $errors->first('points') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.challenge.fields.points_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.capsuleFileDropzone = {
    url: '{{ route('admin.challenges.storeMedia') }}',
    maxFilesize: 10, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').find('input[name="capsule_file"]').remove()
      $('form').append('<input type="hidden" name="capsule_file" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="capsule_file"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($challenge) && $challenge->capsule_file)
      var file = {!! json_encode($challenge->capsule_file) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="capsule_file" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection