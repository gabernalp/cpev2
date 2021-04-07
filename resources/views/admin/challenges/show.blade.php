@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.challenge.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.challenges.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.challenge.fields.id') }}
                        </th>
                        <td>
                            {{ $challenge->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.challenge.fields.courses') }}
                        </th>
                        <td>
                            @foreach($challenge->courses as $key => $courses)
                                <span class="label label-info">{{ $courses->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.challenge.fields.name') }}
                        </th>
                        <td>
                            {{ $challenge->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.challenge.fields.description') }}
                        </th>
                        <td>
                            {{ $challenge->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.challenge.fields.goal') }}
                        </th>
                        <td>
                            {{ $challenge->goal }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.challenge.fields.capsule') }}
                        </th>
                        <td>
                            {{ $challenge->capsule }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.challenge.fields.capsule_content') }}
                        </th>
                        <td>
                            {{ $challenge->capsule_content }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.challenge.fields.capsule_file') }}
                        </th>
                        <td>
                            @if($challenge->capsule_file)
                                <a href="{{ $challenge->capsule_file->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.challenge.fields.challenge_action') }}
                        </th>
                        <td>
                            {{ App\Models\Challenge::CHALLENGE_ACTION_SELECT[$challenge->challenge_action] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.challenge.fields.action_detail') }}
                        </th>
                        <td>
                            {{ $challenge->action_detail }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.challenge.fields.limit_time') }}
                        </th>
                        <td>
                            {{ App\Models\Challenge::LIMIT_TIME_SELECT[$challenge->limit_time] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.challenge.fields.referencetype') }}
                        </th>
                        <td>
                            {{ $challenge->referencetype->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.challenge.fields.hours_adding') }}
                        </th>
                        <td>
                            {{ $challenge->hours_adding }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.challenge.fields.points') }}
                        </th>
                        <td>
                            @foreach($challenge->points as $key => $points)
                                <span class="label label-info">{{ $points->points_item }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.challenges.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#challenge_challenges_users" role="tab" data-toggle="tab">
                {{ trans('cruds.challengesUser.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="challenge_challenges_users">
            @includeIf('admin.challenges.relationships.challengeChallengesUsers', ['challengesUsers' => $challenge->challengeChallengesUsers])
        </div>
    </div>
</div>

@endsection