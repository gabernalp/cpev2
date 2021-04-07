@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.feedbacksUser.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.feedbacks-users.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.feedbacksUser.fields.user') }}</label>
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
                <span class="help-block">{{ trans('cruds.feedbacksUser.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="feedbacktype_id">{{ trans('cruds.feedbacksUser.fields.feedbacktype') }}</label>
                <select class="form-control select2 {{ $errors->has('feedbacktype') ? 'is-invalid' : '' }}" name="feedbacktype_id" id="feedbacktype_id" required>
                    @foreach($feedbacktypes as $id => $feedbacktype)
                        <option value="{{ $id }}" {{ old('feedbacktype_id') == $id ? 'selected' : '' }}>{{ $feedbacktype }}</option>
                    @endforeach
                </select>
                @if($errors->has('feedbacktype'))
                    <div class="invalid-feedback">
                        {{ $errors->first('feedbacktype') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.feedbacksUser.fields.feedbacktype_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="referencetype_id">{{ trans('cruds.feedbacksUser.fields.referencetype') }}</label>
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
                <span class="help-block">{{ trans('cruds.feedbacksUser.fields.referencetype_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file">{{ trans('cruds.feedbacksUser.fields.file') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file') ? 'is-invalid' : '' }}" id="file-dropzone">
                </div>
                @if($errors->has('file'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.feedbacksUser.fields.file_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.feedbacksUser.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.feedbacksUser.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link">{{ trans('cruds.feedbacksUser.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', '') }}">
                @if($errors->has('link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.feedbacksUser.fields.link_helper') }}</span>
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
    url: '{{ route('admin.feedbacks-users.storeMedia') }}',
    maxFilesize: 5, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
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
@if(isset($feedbacksUser) && $feedbacksUser->file)
      var file = {!! json_encode($feedbacksUser->file) !!}
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