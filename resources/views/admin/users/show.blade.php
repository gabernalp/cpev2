@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.user.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.documenttype') }}
                        </th>
                        <td>
                            {{ $user->documenttype->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.document') }}
                        </th>
                        <td>
                            {{ $user->document }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.last_name') }}
                        </th>
                        <td>
                            {{ $user->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.gender') }}
                        </th>
                        <td>
                            {{ App\Models\User::GENDER_SELECT[$user->gender] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.phone') }}
                        </th>
                        <td>
                            {{ $user->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.phone_2') }}
                        </th>
                        <td>
                            {{ $user->phone_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.department') }}
                        </th>
                        <td>
                            {{ $user->department->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.city') }}
                        </th>
                        <td>
                            {{ $user->city->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.zona') }}
                        </th>
                        <td>
                            {{ App\Models\User::ZONA_SELECT[$user->zona] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.etnia') }}
                        </th>
                        <td>
                            {{ App\Models\User::ETNIA_SELECT[$user->etnia] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.academic_background') }}
                        </th>
                        <td>
                            {{ App\Models\User::ACADEMIC_BACKGROUND_SELECT[$user->academic_background] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.devices') }}
                        </th>
                        <td>
                            @foreach($user->devices as $key => $devices)
                                <span class="label label-info">{{ $devices->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.place_role') }}
                        </th>
                        <td>
                            {{ App\Models\User::PLACE_ROLE_SELECT[$user->place_role] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.labour_role') }}
                        </th>
                        <td>
                            {{ App\Models\User::LABOUR_ROLE_SELECT[$user->labour_role] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.modality') }}
                        </th>
                        <td>
                            {{ App\Models\User::MODALITY_SELECT[$user->modality] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.entity') }}
                        </th>
                        <td>
                            {{ $user->entity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.operator') }}
                        </th>
                        <td>
                            {{ $user->operator->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.newsletter_subscription') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $user->newsletter_subscription ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.motivation') }}
                        </th>
                        <td>
                            {{ $user->motivation }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.experience') }}
                        </th>
                        <td>
                            {{ App\Models\User::EXPERIENCE_SELECT[$user->experience] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email_verified_at') }}
                        </th>
                        <td>
                            {{ $user->email_verified_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.verified') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $user->verified ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
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
            <a class="nav-link" href="#user_feedbacks_users" role="tab" data-toggle="tab">
                {{ trans('cruds.feedbacksUser.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_courses_users" role="tab" data-toggle="tab">
                {{ trans('cruds.coursesUser.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_challenges_users" role="tab" data-toggle="tab">
                {{ trans('cruds.challengesUser.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_meetings" role="tab" data-toggle="tab">
                {{ trans('cruds.meeting.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_user_chain_blocks" role="tab" data-toggle="tab">
                {{ trans('cruds.userChainBlock.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_badges_users" role="tab" data-toggle="tab">
                {{ trans('cruds.badgesUser.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_user_alerts" role="tab" data-toggle="tab">
                {{ trans('cruds.userAlert.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#tutors_course_schedules" role="tab" data-toggle="tab">
                {{ trans('cruds.courseSchedule.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="user_feedbacks_users">
            @includeIf('admin.users.relationships.userFeedbacksUsers', ['feedbacksUsers' => $user->userFeedbacksUsers])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_courses_users">
            @includeIf('admin.users.relationships.userCoursesUsers', ['coursesUsers' => $user->userCoursesUsers])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_challenges_users">
            @includeIf('admin.users.relationships.userChallengesUsers', ['challengesUsers' => $user->userChallengesUsers])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_meetings">
            @includeIf('admin.users.relationships.userMeetings', ['meetings' => $user->userMeetings])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_user_chain_blocks">
            @includeIf('admin.users.relationships.userUserChainBlocks', ['userChainBlocks' => $user->userUserChainBlocks])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_badges_users">
            @includeIf('admin.users.relationships.userBadgesUsers', ['badgesUsers' => $user->userBadgesUsers])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_user_alerts">
            @includeIf('admin.users.relationships.userUserAlerts', ['userAlerts' => $user->userUserAlerts])
        </div>
        <div class="tab-pane" role="tabpanel" id="tutors_course_schedules">
            @includeIf('admin.users.relationships.tutorsCourseSchedules', ['courseSchedules' => $user->tutorsCourseSchedules])
        </div>
    </div>
</div>

@endsection