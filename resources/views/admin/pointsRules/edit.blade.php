@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.pointsRule.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.points-rules.update", [$pointsRule->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="points_item">{{ trans('cruds.pointsRule.fields.points_item') }}</label>
                <input class="form-control {{ $errors->has('points_item') ? 'is-invalid' : '' }}" type="text" name="points_item" id="points_item" value="{{ old('points_item', $pointsRule->points_item) }}" required>
                @if($errors->has('points_item'))
                    <div class="invalid-feedback">
                        {{ $errors->first('points_item') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pointsRule.fields.points_item_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="points">{{ trans('cruds.pointsRule.fields.points') }}</label>
                <input class="form-control {{ $errors->has('points') ? 'is-invalid' : '' }}" type="number" name="points" id="points" value="{{ old('points', $pointsRule->points) }}" step="1">
                @if($errors->has('points'))
                    <div class="invalid-feedback">
                        {{ $errors->first('points') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pointsRule.fields.points_helper') }}</span>
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