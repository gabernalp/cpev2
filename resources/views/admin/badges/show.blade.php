@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.badge.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.badges.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.badge.fields.id') }}
                        </th>
                        <td>
                            {{ $badge->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.badge.fields.name') }}
                        </th>
                        <td>
                            {{ $badge->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.badge.fields.image') }}
                        </th>
                        <td>
                            @if($badge->image)
                                <a href="{{ $badge->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $badge->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.badge.fields.points') }}
                        </th>
                        <td>
                            {{ $badge->points }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.badges.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection