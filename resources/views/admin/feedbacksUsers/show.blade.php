@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.feedbacksUser.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.feedbacks-users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.feedbacksUser.fields.id') }}
                        </th>
                        <td>
                            {{ $feedbacksUser->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.feedbacksUser.fields.programmed_course') }}
                        </th>
                        <td>
                            {{ $feedbacksUser->programmed_course->start_date ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.feedbacksUser.fields.user') }}
                        </th>
                        <td>
                            {{ $feedbacksUser->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.feedbacksUser.fields.feedbacktype') }}
                        </th>
                        <td>
                            {{ $feedbacksUser->feedbacktype->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.feedbacksUser.fields.referencetype') }}
                        </th>
                        <td>
                            {{ $feedbacksUser->referencetype->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.feedbacksUser.fields.file') }}
                        </th>
                        <td>
                            @if($feedbacksUser->file)
                                <a href="{{ $feedbacksUser->file->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.feedbacksUser.fields.description') }}
                        </th>
                        <td>
                            {{ $feedbacksUser->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.feedbacksUser.fields.link') }}
                        </th>
                        <td>
                            {{ $feedbacksUser->link }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.feedbacks-users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection