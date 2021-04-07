<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li>
            <select class="searchable-field form-control">

            </select>
        </li>
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/audit-logs*") ? "c-show" : "" }} {{ request()->is("admin/user-alerts*") ? "c-show" : "" }} {{ request()->is("admin/user-chain-blocks*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_alert_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.user-alerts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.userAlert.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_chain_block_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.user-chain-blocks.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-chain-blocks") || request()->is("admin/user-chain-blocks/*") ? "c-active" : "" }}">
                                <i class="fa-fw fab fa-whatsapp-square c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.userChainBlock.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('global_var_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/tags*") ? "c-show" : "" }} {{ request()->is("admin/entities*") ? "c-show" : "" }} {{ request()->is("admin/departments*") ? "c-show" : "" }} {{ request()->is("admin/cities*") ? "c-show" : "" }} {{ request()->is("admin/document-types*") ? "c-show" : "" }} {{ request()->is("admin/devices*") ? "c-show" : "" }} {{ request()->is("admin/feedback-types*") ? "c-show" : "" }} {{ request()->is("admin/points-rules*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.globalVar.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('tag_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tags.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tags") || request()->is("admin/tags/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-tag c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.tag.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('entity_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.entities.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/entities") || request()->is("admin/entities/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-building c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.entity.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('department_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.departments.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/departments") || request()->is("admin/departments/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-map-marked-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.department.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('city_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.cities.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/cities") || request()->is("admin/cities/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-map-pin c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.city.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('document_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.document-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/document-types") || request()->is("admin/document-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-id-card-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.documentType.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('device_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.devices.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/devices") || request()->is("admin/devices/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-laptop c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.device.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('feedback_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.feedback-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/feedback-types") || request()->is("admin/feedback-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-retweet c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.feedbackType.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('points_rule_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.points-rules.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/points-rules") || request()->is("admin/points-rules/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-sort-numeric-up c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.pointsRule.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('educational_background_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/background-processes*") ? "c-show" : "" }} {{ request()->is("admin/courses*") ? "c-show" : "" }} {{ request()->is("admin/challenges*") ? "c-show" : "" }} {{ request()->is("admin/badges*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-graduation-cap c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.educationalBackground.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('background_process_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.background-processes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/background-processes") || request()->is("admin/background-processes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-chalkboard-teacher c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.backgroundProcess.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('course_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.courses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/courses") || request()->is("admin/courses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-book c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.course.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('challenge_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.challenges.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/challenges") || request()->is("admin/challenges/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-hand-rock c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.challenge.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('badge_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.badges.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/badges") || request()->is("admin/badges/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-award c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.badge.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('programacion_de_ciclo_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/course-schedules*") ? "c-show" : "" }} {{ request()->is("admin/courses-users*") ? "c-show" : "" }} {{ request()->is("admin/challenges-users*") ? "c-show" : "" }} {{ request()->is("admin/feedbacks-users*") ? "c-show" : "" }} {{ request()->is("admin/badges-users*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw far fa-calendar-plus c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.programacionDeCiclo.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('course_schedule_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.course-schedules.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/course-schedules") || request()->is("admin/course-schedules/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-calendar-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.courseSchedule.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('courses_user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.courses-users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/courses-users") || request()->is("admin/courses-users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-edit c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.coursesUser.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('challenges_user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.challenges-users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/challenges-users") || request()->is("admin/challenges-users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-star c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.challengesUser.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('feedbacks_user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.feedbacks-users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/feedbacks-users") || request()->is("admin/feedbacks-users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-sync c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.feedbacksUser.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('badges_user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.badges-users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/badges-users") || request()->is("admin/badges-users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-asterisk c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.badgesUser.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('referencium_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/reference-types*") ? "c-show" : "" }} {{ request()->is("admin/reference-objects*") ? "c-show" : "" }} {{ request()->is("admin/courses-hooks*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-external-link-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.referencium.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('reference_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.reference-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/reference-types") || request()->is("admin/reference-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-vector-square c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.referenceType.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('reference_object_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.reference-objects.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/reference-objects") || request()->is("admin/reference-objects/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-link c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.referenceObject.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('courses_hook_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.courses-hooks.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/courses-hooks") || request()->is("admin/courses-hooks/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-anchor c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.coursesHook.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('operadore_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/operators*") ? "c-show" : "" }} {{ request()->is("admin/contracts*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.operadore.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('operator_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.operators.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/operators") || request()->is("admin/operators/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-hotel c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.operator.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('contract_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.contracts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/contracts") || request()->is("admin/contracts/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contract.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('resources_library_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/resources*") ? "c-show" : "" }} {{ request()->is("admin/resources-categories*") ? "c-show" : "" }} {{ request()->is("admin/resources-subcategories*") ? "c-show" : "" }} {{ request()->is("admin/subcategories-sets*") ? "c-show" : "" }} {{ request()->is("admin/resources-audits*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-book c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.resourcesLibrary.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('resource_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.resources.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/resources") || request()->is("admin/resources/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cube c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.resource.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('resources_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.resources-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/resources-categories") || request()->is("admin/resources-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-list-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.resourcesCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('resources_subcategory_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.resources-subcategories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/resources-subcategories") || request()->is("admin/resources-subcategories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-list-ul c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.resourcesSubcategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('subcategories_set_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.subcategories-sets.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/subcategories-sets") || request()->is("admin/subcategories-sets/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-boxes c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.subcategoriesSet.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('resources_audit_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.resources-audits.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/resources-audits") || request()->is("admin/resources-audits/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-eye c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.resourcesAudit.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('event_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/events-schedules*") ? "c-show" : "" }} {{ request()->is("admin/events-attendants*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-clipboard-list c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.event.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('events_schedule_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.events-schedules.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/events-schedules") || request()->is("admin/events-schedules/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-stopwatch c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.eventsSchedule.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('events_attendant_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.events-attendants.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/events-attendants") || request()->is("admin/events-attendants/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.eventsAttendant.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('community_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/meetings*") ? "c-show" : "" }} {{ request()->is("admin/meeting-attendants*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-user-friends c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.community.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('meeting_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.meetings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/meetings") || request()->is("admin/meetings/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-users-cog c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.meeting.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('meeting_attendant_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.meeting-attendants.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/meeting-attendants") || request()->is("admin/meeting-attendants/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-hand-point-up c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.meetingAttendant.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('self_interested_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/self-interested-users*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-user-check c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.selfInterested.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('self_interested_user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.self-interested-users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/self-interested-users") || request()->is("admin/self-interested-users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-hand-paper c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.selfInterestedUser.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('report_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/educational-bg-reports*") ? "c-show" : "" }} {{ request()->is("admin/communities-reports*") ? "c-show" : "" }} {{ request()->is("admin/general-reports*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-chart-line c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.report.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('educational_bg_report_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.educational-bg-reports.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/educational-bg-reports") || request()->is("admin/educational-bg-reports/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-clipboard-list c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.educationalBgReport.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('communities_report_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.communities-reports.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/communities-reports") || request()->is("admin/communities-reports/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-th-list c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.communitiesReport.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('general_report_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.general-reports.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/general-reports") || request()->is("admin/general-reports/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-chart-bar c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.generalReport.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.systemCalendar") }}" class="c-sidebar-nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "c-active" : "" }}">
                <i class="c-sidebar-nav-icon fa-fw fas fa-calendar">

                </i>
                {{ trans('global.systemCalendar') }}
            </a>
        </li>
        @php($unread = \App\Models\QaTopic::unreadCount())
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "c-active" : "" }} c-sidebar-nav-link">
                    <i class="c-sidebar-nav-icon fa-fw fa fa-envelope">

                    </i>
                    <span>{{ trans('global.messages') }}</span>
                    @if($unread > 0)
                        <strong>( {{ $unread }} )</strong>
                    @endif

                </a>
            </li>
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif
            <li class="c-sidebar-nav-item">
                <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
    </ul>

</div>