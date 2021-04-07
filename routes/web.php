<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::post('permissions/parse-csv-import', 'PermissionsController@parseCsvImport')->name('permissions.parseCsvImport');
    Route::post('permissions/process-csv-import', 'PermissionsController@processCsvImport')->name('permissions.processCsvImport');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::post('roles/parse-csv-import', 'RolesController@parseCsvImport')->name('roles.parseCsvImport');
    Route::post('roles/process-csv-import', 'RolesController@processCsvImport')->name('roles.processCsvImport');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Departments
    Route::delete('departments/destroy', 'DepartmentsController@massDestroy')->name('departments.massDestroy');
    Route::post('departments/parse-csv-import', 'DepartmentsController@parseCsvImport')->name('departments.parseCsvImport');
    Route::post('departments/process-csv-import', 'DepartmentsController@processCsvImport')->name('departments.processCsvImport');
    Route::resource('departments', 'DepartmentsController');

    // Cities
    Route::delete('cities/destroy', 'CitiesController@massDestroy')->name('cities.massDestroy');
    Route::post('cities/parse-csv-import', 'CitiesController@parseCsvImport')->name('cities.parseCsvImport');
    Route::post('cities/process-csv-import', 'CitiesController@processCsvImport')->name('cities.processCsvImport');
    Route::resource('cities', 'CitiesController');

    // Devices
    Route::delete('devices/destroy', 'DevicesController@massDestroy')->name('devices.massDestroy');
    Route::post('devices/parse-csv-import', 'DevicesController@parseCsvImport')->name('devices.parseCsvImport');
    Route::post('devices/process-csv-import', 'DevicesController@processCsvImport')->name('devices.processCsvImport');
    Route::resource('devices', 'DevicesController');

    // Document Types
    Route::delete('document-types/destroy', 'DocumentTypeController@massDestroy')->name('document-types.massDestroy');
    Route::post('document-types/parse-csv-import', 'DocumentTypeController@parseCsvImport')->name('document-types.parseCsvImport');
    Route::post('document-types/process-csv-import', 'DocumentTypeController@processCsvImport')->name('document-types.processCsvImport');
    Route::resource('document-types', 'DocumentTypeController');

    // Operators
    Route::delete('operators/destroy', 'OperatorsController@massDestroy')->name('operators.massDestroy');
    Route::resource('operators', 'OperatorsController');

    // Tags
    Route::delete('tags/destroy', 'TagsController@massDestroy')->name('tags.massDestroy');
    Route::post('tags/parse-csv-import', 'TagsController@parseCsvImport')->name('tags.parseCsvImport');
    Route::post('tags/process-csv-import', 'TagsController@processCsvImport')->name('tags.processCsvImport');
    Route::resource('tags', 'TagsController');

    // Background Processes
    Route::delete('background-processes/destroy', 'BackgroundProcessesController@massDestroy')->name('background-processes.massDestroy');
    Route::post('background-processes/media', 'BackgroundProcessesController@storeMedia')->name('background-processes.storeMedia');
    Route::post('background-processes/ckmedia', 'BackgroundProcessesController@storeCKEditorImages')->name('background-processes.storeCKEditorImages');
    Route::post('background-processes/parse-csv-import', 'BackgroundProcessesController@parseCsvImport')->name('background-processes.parseCsvImport');
    Route::post('background-processes/process-csv-import', 'BackgroundProcessesController@processCsvImport')->name('background-processes.processCsvImport');
    Route::resource('background-processes', 'BackgroundProcessesController');

    // Reference Types
    Route::delete('reference-types/destroy', 'ReferenceTypesController@massDestroy')->name('reference-types.massDestroy');
    Route::post('reference-types/parse-csv-import', 'ReferenceTypesController@parseCsvImport')->name('reference-types.parseCsvImport');
    Route::post('reference-types/process-csv-import', 'ReferenceTypesController@processCsvImport')->name('reference-types.processCsvImport');
    Route::resource('reference-types', 'ReferenceTypesController');

    // Reference Objects
    Route::delete('reference-objects/destroy', 'ReferenceObjectsController@massDestroy')->name('reference-objects.massDestroy');
    Route::post('reference-objects/media', 'ReferenceObjectsController@storeMedia')->name('reference-objects.storeMedia');
    Route::post('reference-objects/ckmedia', 'ReferenceObjectsController@storeCKEditorImages')->name('reference-objects.storeCKEditorImages');
    Route::post('reference-objects/parse-csv-import', 'ReferenceObjectsController@parseCsvImport')->name('reference-objects.parseCsvImport');
    Route::post('reference-objects/process-csv-import', 'ReferenceObjectsController@processCsvImport')->name('reference-objects.processCsvImport');
    Route::resource('reference-objects', 'ReferenceObjectsController');

    // Entities
    Route::delete('entities/destroy', 'EntitiesController@massDestroy')->name('entities.massDestroy');
    Route::post('entities/parse-csv-import', 'EntitiesController@parseCsvImport')->name('entities.parseCsvImport');
    Route::post('entities/process-csv-import', 'EntitiesController@processCsvImport')->name('entities.processCsvImport');
    Route::resource('entities', 'EntitiesController');

    // Courses Hooks
    Route::delete('courses-hooks/destroy', 'CoursesHooksController@massDestroy')->name('courses-hooks.massDestroy');
    Route::post('courses-hooks/media', 'CoursesHooksController@storeMedia')->name('courses-hooks.storeMedia');
    Route::post('courses-hooks/ckmedia', 'CoursesHooksController@storeCKEditorImages')->name('courses-hooks.storeCKEditorImages');
    Route::post('courses-hooks/parse-csv-import', 'CoursesHooksController@parseCsvImport')->name('courses-hooks.parseCsvImport');
    Route::post('courses-hooks/process-csv-import', 'CoursesHooksController@processCsvImport')->name('courses-hooks.processCsvImport');
    Route::resource('courses-hooks', 'CoursesHooksController');

    // Courses
    Route::delete('courses/destroy', 'CoursesController@massDestroy')->name('courses.massDestroy');
    Route::post('courses/parse-csv-import', 'CoursesController@parseCsvImport')->name('courses.parseCsvImport');
    Route::post('courses/process-csv-import', 'CoursesController@processCsvImport')->name('courses.processCsvImport');
    Route::resource('courses', 'CoursesController');

    // Contracts
    Route::delete('contracts/destroy', 'ContractsController@massDestroy')->name('contracts.massDestroy');
    Route::resource('contracts', 'ContractsController');

    // Points Rules
    Route::delete('points-rules/destroy', 'PointsRulesController@massDestroy')->name('points-rules.massDestroy');
    Route::post('points-rules/parse-csv-import', 'PointsRulesController@parseCsvImport')->name('points-rules.parseCsvImport');
    Route::post('points-rules/process-csv-import', 'PointsRulesController@processCsvImport')->name('points-rules.processCsvImport');
    Route::resource('points-rules', 'PointsRulesController');

    // Challenges
    Route::delete('challenges/destroy', 'ChallengesController@massDestroy')->name('challenges.massDestroy');
    Route::post('challenges/media', 'ChallengesController@storeMedia')->name('challenges.storeMedia');
    Route::post('challenges/ckmedia', 'ChallengesController@storeCKEditorImages')->name('challenges.storeCKEditorImages');
    Route::post('challenges/parse-csv-import', 'ChallengesController@parseCsvImport')->name('challenges.parseCsvImport');
    Route::post('challenges/process-csv-import', 'ChallengesController@processCsvImport')->name('challenges.processCsvImport');
    Route::resource('challenges', 'ChallengesController');

    // Badges
    Route::delete('badges/destroy', 'BadgesController@massDestroy')->name('badges.massDestroy');
    Route::post('badges/media', 'BadgesController@storeMedia')->name('badges.storeMedia');
    Route::post('badges/ckmedia', 'BadgesController@storeCKEditorImages')->name('badges.storeCKEditorImages');
    Route::post('badges/parse-csv-import', 'BadgesController@parseCsvImport')->name('badges.parseCsvImport');
    Route::post('badges/process-csv-import', 'BadgesController@processCsvImport')->name('badges.processCsvImport');
    Route::resource('badges', 'BadgesController');

    // Feedback Types
    Route::delete('feedback-types/destroy', 'FeedbackTypesController@massDestroy')->name('feedback-types.massDestroy');
    Route::post('feedback-types/parse-csv-import', 'FeedbackTypesController@parseCsvImport')->name('feedback-types.parseCsvImport');
    Route::post('feedback-types/process-csv-import', 'FeedbackTypesController@processCsvImport')->name('feedback-types.processCsvImport');
    Route::resource('feedback-types', 'FeedbackTypesController');

    // Course Schedules
    Route::delete('course-schedules/destroy', 'CourseSchedulesController@massDestroy')->name('course-schedules.massDestroy');
    Route::post('course-schedules/parse-csv-import', 'CourseSchedulesController@parseCsvImport')->name('course-schedules.parseCsvImport');
    Route::post('course-schedules/process-csv-import', 'CourseSchedulesController@processCsvImport')->name('course-schedules.processCsvImport');
    Route::resource('course-schedules', 'CourseSchedulesController');

    // Feedbacks Users
    Route::delete('feedbacks-users/destroy', 'FeedbacksUsersController@massDestroy')->name('feedbacks-users.massDestroy');
    Route::post('feedbacks-users/media', 'FeedbacksUsersController@storeMedia')->name('feedbacks-users.storeMedia');
    Route::post('feedbacks-users/ckmedia', 'FeedbacksUsersController@storeCKEditorImages')->name('feedbacks-users.storeCKEditorImages');
    Route::resource('feedbacks-users', 'FeedbacksUsersController');

    // Courses Users
    Route::delete('courses-users/destroy', 'CoursesUsersController@massDestroy')->name('courses-users.massDestroy');
    Route::post('courses-users/parse-csv-import', 'CoursesUsersController@parseCsvImport')->name('courses-users.parseCsvImport');
    Route::post('courses-users/process-csv-import', 'CoursesUsersController@processCsvImport')->name('courses-users.processCsvImport');
    Route::resource('courses-users', 'CoursesUsersController');

    // Challenges Users
    Route::delete('challenges-users/destroy', 'ChallengesUsersController@massDestroy')->name('challenges-users.massDestroy');
    Route::post('challenges-users/media', 'ChallengesUsersController@storeMedia')->name('challenges-users.storeMedia');
    Route::post('challenges-users/ckmedia', 'ChallengesUsersController@storeCKEditorImages')->name('challenges-users.storeCKEditorImages');
    Route::post('challenges-users/parse-csv-import', 'ChallengesUsersController@parseCsvImport')->name('challenges-users.parseCsvImport');
    Route::post('challenges-users/process-csv-import', 'ChallengesUsersController@processCsvImport')->name('challenges-users.processCsvImport');
    Route::resource('challenges-users', 'ChallengesUsersController');

    // Resources Categories
    Route::delete('resources-categories/destroy', 'ResourcesCategoriesController@massDestroy')->name('resources-categories.massDestroy');
    Route::post('resources-categories/parse-csv-import', 'ResourcesCategoriesController@parseCsvImport')->name('resources-categories.parseCsvImport');
    Route::post('resources-categories/process-csv-import', 'ResourcesCategoriesController@processCsvImport')->name('resources-categories.processCsvImport');
    Route::resource('resources-categories', 'ResourcesCategoriesController');

    // Resources Subcategories
    Route::delete('resources-subcategories/destroy', 'ResourcesSubcategoriesController@massDestroy')->name('resources-subcategories.massDestroy');
    Route::post('resources-subcategories/parse-csv-import', 'ResourcesSubcategoriesController@parseCsvImport')->name('resources-subcategories.parseCsvImport');
    Route::post('resources-subcategories/process-csv-import', 'ResourcesSubcategoriesController@processCsvImport')->name('resources-subcategories.processCsvImport');
    Route::resource('resources-subcategories', 'ResourcesSubcategoriesController');

    // Subcategories Sets
    Route::delete('subcategories-sets/destroy', 'SubcategoriesSetsController@massDestroy')->name('subcategories-sets.massDestroy');
    Route::post('subcategories-sets/parse-csv-import', 'SubcategoriesSetsController@parseCsvImport')->name('subcategories-sets.parseCsvImport');
    Route::post('subcategories-sets/process-csv-import', 'SubcategoriesSetsController@processCsvImport')->name('subcategories-sets.processCsvImport');
    Route::resource('subcategories-sets', 'SubcategoriesSetsController');

    // Resources
    Route::delete('resources/destroy', 'ResourcesController@massDestroy')->name('resources.massDestroy');
    Route::post('resources/media', 'ResourcesController@storeMedia')->name('resources.storeMedia');
    Route::post('resources/ckmedia', 'ResourcesController@storeCKEditorImages')->name('resources.storeCKEditorImages');
    Route::post('resources/parse-csv-import', 'ResourcesController@parseCsvImport')->name('resources.parseCsvImport');
    Route::post('resources/process-csv-import', 'ResourcesController@processCsvImport')->name('resources.processCsvImport');
    Route::resource('resources', 'ResourcesController');

    // Events Schedules
    Route::delete('events-schedules/destroy', 'EventsSchedulesController@massDestroy')->name('events-schedules.massDestroy');
    Route::post('events-schedules/media', 'EventsSchedulesController@storeMedia')->name('events-schedules.storeMedia');
    Route::post('events-schedules/ckmedia', 'EventsSchedulesController@storeCKEditorImages')->name('events-schedules.storeCKEditorImages');
    Route::post('events-schedules/parse-csv-import', 'EventsSchedulesController@parseCsvImport')->name('events-schedules.parseCsvImport');
    Route::post('events-schedules/process-csv-import', 'EventsSchedulesController@processCsvImport')->name('events-schedules.processCsvImport');
    Route::resource('events-schedules', 'EventsSchedulesController');

    // Events Attendants
    Route::delete('events-attendants/destroy', 'EventsAttendantsController@massDestroy')->name('events-attendants.massDestroy');
    Route::post('events-attendants/parse-csv-import', 'EventsAttendantsController@parseCsvImport')->name('events-attendants.parseCsvImport');
    Route::post('events-attendants/process-csv-import', 'EventsAttendantsController@processCsvImport')->name('events-attendants.processCsvImport');
    Route::resource('events-attendants', 'EventsAttendantsController');

    // Meetings
    Route::delete('meetings/destroy', 'MeetingsController@massDestroy')->name('meetings.massDestroy');
    Route::post('meetings/media', 'MeetingsController@storeMedia')->name('meetings.storeMedia');
    Route::post('meetings/ckmedia', 'MeetingsController@storeCKEditorImages')->name('meetings.storeCKEditorImages');
    Route::resource('meetings', 'MeetingsController');

    // Meeting Attendants
    Route::delete('meeting-attendants/destroy', 'MeetingAttendantsController@massDestroy')->name('meeting-attendants.massDestroy');
    Route::post('meeting-attendants/parse-csv-import', 'MeetingAttendantsController@parseCsvImport')->name('meeting-attendants.parseCsvImport');
    Route::post('meeting-attendants/process-csv-import', 'MeetingAttendantsController@processCsvImport')->name('meeting-attendants.processCsvImport');
    Route::resource('meeting-attendants', 'MeetingAttendantsController');

    // Self Interested Users
    Route::delete('self-interested-users/destroy', 'SelfInterestedUsersController@massDestroy')->name('self-interested-users.massDestroy');
    Route::post('self-interested-users/parse-csv-import', 'SelfInterestedUsersController@parseCsvImport')->name('self-interested-users.parseCsvImport');
    Route::post('self-interested-users/process-csv-import', 'SelfInterestedUsersController@processCsvImport')->name('self-interested-users.processCsvImport');
    Route::resource('self-interested-users', 'SelfInterestedUsersController');

    // User Chain Blocks
    Route::delete('user-chain-blocks/destroy', 'UserChainBlocksController@massDestroy')->name('user-chain-blocks.massDestroy');
    Route::resource('user-chain-blocks', 'UserChainBlocksController');

    // Resources Audits
    Route::delete('resources-audits/destroy', 'ResourcesAuditsController@massDestroy')->name('resources-audits.massDestroy');
    Route::post('resources-audits/parse-csv-import', 'ResourcesAuditsController@parseCsvImport')->name('resources-audits.parseCsvImport');
    Route::post('resources-audits/process-csv-import', 'ResourcesAuditsController@processCsvImport')->name('resources-audits.processCsvImport');
    Route::resource('resources-audits', 'ResourcesAuditsController');

    // Educational Bg Reports
    Route::resource('educational-bg-reports', 'EducationalBgReportsController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Communities Reports
    Route::resource('communities-reports', 'CommunitiesReportsController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // General Reports
    Route::resource('general-reports', 'GeneralReportsController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Badges Users
    Route::delete('badges-users/destroy', 'BadgesUsersController@massDestroy')->name('badges-users.massDestroy');
    Route::resource('badges-users', 'BadgesUsersController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
