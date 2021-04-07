@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.coursesHook.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.courses-hooks.update", [$coursesHook->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.coursesHook.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $coursesHook->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coursesHook.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.coursesHook.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $coursesHook->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coursesHook.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="specific_category">{{ trans('cruds.coursesHook.fields.specific_category') }}</label>
                <input class="form-control {{ $errors->has('specific_category') ? 'is-invalid' : '' }}" type="text" name="specific_category" id="specific_category" value="{{ old('specific_category', $coursesHook->specific_category) }}">
                @if($errors->has('specific_category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('specific_category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coursesHook.fields.specific_category_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="entities">{{ trans('cruds.coursesHook.fields.entity') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('entities') ? 'is-invalid' : '' }}" name="entities[]" id="entities" multiple>
                    @foreach($entities as $id => $entity)
                        <option value="{{ $id }}" {{ (in_array($id, old('entities', [])) || $coursesHook->entities->contains($id)) ? 'selected' : '' }}>{{ $entity }}</option>
                    @endforeach
                </select>
                @if($errors->has('entities'))
                    <div class="invalid-feedback">
                        {{ $errors->first('entities') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coursesHook.fields.entity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="departments">{{ trans('cruds.coursesHook.fields.department') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('departments') ? 'is-invalid' : '' }}" name="departments[]" id="departments" multiple>
                    @foreach($departments as $id => $department)
                        <option value="{{ $id }}" {{ (in_array($id, old('departments', [])) || $coursesHook->departments->contains($id)) ? 'selected' : '' }}>{{ $department }}</option>
                    @endforeach
                </select>
                @if($errors->has('departments'))
                    <div class="invalid-feedback">
                        {{ $errors->first('departments') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coursesHook.fields.department_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="requirements">{{ trans('cruds.coursesHook.fields.requirements') }}</label>
                <textarea class="form-control {{ $errors->has('requirements') ? 'is-invalid' : '' }}" name="requirements" id="requirements">{{ old('requirements', $coursesHook->requirements) }}</textarea>
                @if($errors->has('requirements'))
                    <div class="invalid-feedback">
                        {{ $errors->first('requirements') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coursesHook.fields.requirements_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link">{{ trans('cruds.coursesHook.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', $coursesHook->link) }}">
                @if($errors->has('link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coursesHook.fields.link_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('priorized') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="priorized" value="0">
                    <input class="form-check-input" type="checkbox" name="priorized" id="priorized" value="1" {{ $coursesHook->priorized || old('priorized', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="priorized">{{ trans('cruds.coursesHook.fields.priorized') }}</label>
                </div>
                @if($errors->has('priorized'))
                    <div class="invalid-feedback">
                        {{ $errors->first('priorized') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coursesHook.fields.priorized_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('exclusive') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="exclusive" value="0">
                    <input class="form-check-input" type="checkbox" name="exclusive" id="exclusive" value="1" {{ $coursesHook->exclusive || old('exclusive', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="exclusive">{{ trans('cruds.coursesHook.fields.exclusive') }}</label>
                </div>
                @if($errors->has('exclusive'))
                    <div class="invalid-feedback">
                        {{ $errors->first('exclusive') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coursesHook.fields.exclusive_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.coursesHook.fields.educational_level_exclusive') }}</label>
                <select class="form-control {{ $errors->has('educational_level_exclusive') ? 'is-invalid' : '' }}" name="educational_level_exclusive" id="educational_level_exclusive">
                    <option value disabled {{ old('educational_level_exclusive', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\CoursesHook::EDUCATIONAL_LEVEL_EXCLUSIVE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('educational_level_exclusive', $coursesHook->educational_level_exclusive) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('educational_level_exclusive'))
                    <div class="invalid-feedback">
                        {{ $errors->first('educational_level_exclusive') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coursesHook.fields.educational_level_exclusive_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('community') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="community" value="0">
                    <input class="form-check-input" type="checkbox" name="community" id="community" value="1" {{ $coursesHook->community || old('community', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="community">{{ trans('cruds.coursesHook.fields.community') }}</label>
                </div>
                @if($errors->has('community'))
                    <div class="invalid-feedback">
                        {{ $errors->first('community') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coursesHook.fields.community_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('institutional') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="institutional" value="0">
                    <input class="form-check-input" type="checkbox" name="institutional" id="institutional" value="1" {{ $coursesHook->institutional || old('institutional', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="institutional">{{ trans('cruds.coursesHook.fields.institutional') }}</label>
                </div>
                @if($errors->has('institutional'))
                    <div class="invalid-feedback">
                        {{ $errors->first('institutional') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coursesHook.fields.institutional_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('family') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="family" value="0">
                    <input class="form-check-input" type="checkbox" name="family" id="family" value="1" {{ $coursesHook->family || old('family', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="family">{{ trans('cruds.coursesHook.fields.family') }}</label>
                </div>
                @if($errors->has('family'))
                    <div class="invalid-feedback">
                        {{ $errors->first('family') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coursesHook.fields.family_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('intercultural') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="intercultural" value="0">
                    <input class="form-check-input" type="checkbox" name="intercultural" id="intercultural" value="1" {{ $coursesHook->intercultural || old('intercultural', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="intercultural">{{ trans('cruds.coursesHook.fields.intercultural') }}</label>
                </div>
                @if($errors->has('intercultural'))
                    <div class="invalid-feedback">
                        {{ $errors->first('intercultural') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coursesHook.fields.intercultural_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('coordinator') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="coordinator" value="0">
                    <input class="form-check-input" type="checkbox" name="coordinator" id="coordinator" value="1" {{ $coursesHook->coordinator || old('coordinator', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="coordinator">{{ trans('cruds.coursesHook.fields.coordinator') }}</label>
                </div>
                @if($errors->has('coordinator'))
                    <div class="invalid-feedback">
                        {{ $errors->first('coordinator') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coursesHook.fields.coordinator_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.coursesHook.fields.educational_group') }}</label>
                <select class="form-control {{ $errors->has('educational_group') ? 'is-invalid' : '' }}" name="educational_group" id="educational_group">
                    <option value disabled {{ old('educational_group', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\CoursesHook::EDUCATIONAL_GROUP_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('educational_group', $coursesHook->educational_group) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('educational_group'))
                    <div class="invalid-feedback">
                        {{ $errors->first('educational_group') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coursesHook.fields.educational_group_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.coursesHook.fields.educational_level') }}</label>
                <select class="form-control {{ $errors->has('educational_level') ? 'is-invalid' : '' }}" name="educational_level" id="educational_level">
                    <option value disabled {{ old('educational_level', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\CoursesHook::EDUCATIONAL_LEVEL_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('educational_level', $coursesHook->educational_level) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('educational_level'))
                    <div class="invalid-feedback">
                        {{ $errors->first('educational_level') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coursesHook.fields.educational_level_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file">{{ trans('cruds.coursesHook.fields.file') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file') ? 'is-invalid' : '' }}" id="file-dropzone">
                </div>
                @if($errors->has('file'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coursesHook.fields.file_helper') }}</span>
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
    Dropzone.options.fileDropzone = {
    url: '{{ route('admin.courses-hooks.storeMedia') }}',
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
      $('form').find('input[name="file"]').remove()
      $('form').append('<input type="hidden" name="file" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="file"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($coursesHook) && $coursesHook->file)
      var file = {!! json_encode($coursesHook->file) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="file" value="' + file.file_name + '">')
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