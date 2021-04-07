@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.referenceObject.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.reference-objects.update", [$referenceObject->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="referencetype_id">{{ trans('cruds.referenceObject.fields.referencetype') }}</label>
                <select class="form-control select2 {{ $errors->has('referencetype') ? 'is-invalid' : '' }}" name="referencetype_id" id="referencetype_id">
                    @foreach($referencetypes as $id => $referencetype)
                        <option value="{{ $id }}" {{ (old('referencetype_id') ? old('referencetype_id') : $referenceObject->referencetype->id ?? '') == $id ? 'selected' : '' }}>{{ $referencetype }}</option>
                    @endforeach
                </select>
                @if($errors->has('referencetype'))
                    <div class="invalid-feedback">
                        {{ $errors->first('referencetype') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.referenceObject.fields.referencetype_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="title">{{ trans('cruds.referenceObject.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $referenceObject->title) }}">
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.referenceObject.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link">{{ trans('cruds.referenceObject.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', $referenceObject->link) }}">
                @if($errors->has('link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.referenceObject.fields.link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file">{{ trans('cruds.referenceObject.fields.file') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file') ? 'is-invalid' : '' }}" id="file-dropzone">
                </div>
                @if($errors->has('file'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.referenceObject.fields.file_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="image">{{ trans('cruds.referenceObject.fields.image') }}</label>
                <input class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" type="text" name="image" id="image" value="{{ old('image', $referenceObject->image) }}">
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.referenceObject.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tags">{{ trans('cruds.referenceObject.fields.tags') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                    @foreach($tags as $id => $tags)
                        <option value="{{ $id }}" {{ (in_array($id, old('tags', [])) || $referenceObject->tags->contains($id)) ? 'selected' : '' }}>{{ $tags }}</option>
                    @endforeach
                </select>
                @if($errors->has('tags'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tags') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.referenceObject.fields.tags_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="comments">{{ trans('cruds.referenceObject.fields.comments') }}</label>
                <input class="form-control {{ $errors->has('comments') ? 'is-invalid' : '' }}" type="text" name="comments" id="comments" value="{{ old('comments', $referenceObject->comments) }}">
                @if($errors->has('comments'))
                    <div class="invalid-feedback">
                        {{ $errors->first('comments') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.referenceObject.fields.comments_helper') }}</span>
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
    url: '{{ route('admin.reference-objects.storeMedia') }}',
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
@if(isset($referenceObject) && $referenceObject->file)
      var file = {!! json_encode($referenceObject->file) !!}
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