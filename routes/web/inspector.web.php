<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'inspector', 'namespace' => 'Inspector'], function () {
    Route::get('', 'InspectorController')
        ->name('inspector.index');

    Route::group(['prefix' => 'profile'], function () {
        Route::get('', 'ProfileController')
            ->name('inspector.profile');
        Route::patch('update-avatar', 'ProfileController@updateAvatar')
            ->name('inspector.update.avatar');
    });

    Route::group(['prefix' => 'tasks', 'namespace' => 'Tasks'], function () {
        Route::get('', 'TaskController')
            ->name('inspector.tasks.index');
        Route::match(['get', 'post'], 'create', 'TaskController@create')
            ->name('inspector.tasks.create');
        Route::match(['get', 'post'], 'update/{id}', 'TaskController@update')
            ->name('inspector.tasks.update');
    });

    Route::group(['prefix' => 'employees', 'namespace' => 'Employees'], function () {
        Route::get('', 'EmployeeController')
            ->name('inspector.employees.index');
        Route::match(['get', 'post'], 'create', 'EmployeeController@create')
            ->name('inspector.employees.create');
        Route::match(['get', 'post'], 'update/{id}', 'EmployeeController@update')
            ->name('inspector.employees.update');
    });

    Route::group(['prefix' => 'departments', 'namespace' => 'Departments'], function () {
        Route::get('', 'DepartmentController')
            ->name('inspector.departments.index');
        Route::match(['get', 'post'], 'create', 'DepartmentController@create')
            ->name('inspector.departments.create');
        Route::match(['get', 'post'], 'update/{id}', 'DepartmentController@update')
            ->name('inspector.departments.update');
    });

    Route::group(['prefix' => 'newsletter', 'namespace' => 'Newsletter'], function () {
        Route::get('', 'NewsletterPostController')
            ->name('inspector.newsletter.index');
        Route::match(['get', 'post'], 'create', 'NewsletterPostController@create')
            ->name('inspector.newsletter.create');
        Route::match(['get', 'post'], 'update/{id}', 'NewsletterPostController@update')
            ->name('inspector.newsletter.update');
    });

    Route::group(['prefix' => 'documents', 'namespace' => 'Documents'], function () {
        Route::get('', 'DocumentController')
            ->name('inspector.documents.index');
        Route::match(['get', 'post'], 'create', 'DocumentController@create')
            ->name('inspector.documents.create');
        Route::match(['get', 'post'], 'update/{id}', 'DocumentController@update')
            ->name('inspector.documents.update');
    });

    Route::group(['prefix' => 'applications', 'namespace' => 'Applications'], function () {
        Route::group(['prefix' => 'conclusions'], function () {
            Route::get('', 'ApplicationConclusionController')
                ->name('inspector.applications.conclusions.index');
            Route::match(['get', 'post'], 'create', 'ApplicationConclusionController@create')
                ->name('inspector.applications.conclusions.create');
            Route::match(['get', 'post'], 'update/{id}', 'ApplicationConclusionController@update')
                ->name('inspector.applications.conclusions.update');
        });

        Route::group(['prefix' => 'issues'], function () {
            Route::get('', 'ApplicationIssueController')
                ->name('inspector.applications.issues.index');
            Route::match(['get', 'post'], 'create', 'ApplicationIssueController@create')
                ->name('inspector.applications.issues.create');
            Route::match(['get', 'post'], 'update/{id}', 'ApplicationIssueController@update')
                ->name('inspector.applications.issues.update');
        });

        Route::group(['prefix' => 'incidents'], function () {
            Route::get('', 'ApplicationIncidentsController')
                ->name('inspector.applications.incidents.index');
            Route::match(['get', 'post'], 'create', 'ApplicationIncidentsController@create')
                ->name('inspector.applications.incidents.create');
            Route::match(['get', 'post'], 'update/{id}', 'ApplicationIncidentsController@update')
                ->name('inspector.applications.incidents.update');
        });

    });

    Route::group(['prefix' => 'meetings', 'namespace' => 'Meetings'], function () {
        Route::get('', 'MeetingController')
            ->name('inspector.meetings.index');
        Route::match(['get', 'post'], 'create', 'MeetingController@create')
            ->name('inspector.meetings.create');
        Route::match(['get', 'post'], 'update/{id}', 'MeetingController@update')
            ->name('inspector.meetings.update');
    });

    Route::group(['prefix' => 'datasets', 'namespace' => 'Datasets'], function () {
        Route::get('', 'DatasetController')
            ->name('inspector.datasets.index');
        Route::match(['get', 'post'], 'create', 'DatasetController@create')
            ->name('inspector.datasets.create');
        Route::match(['get', 'post'], 'update/{id}', 'DatasetController@update')
            ->name('inspector.datasets.update');
    });

    Route::group(['prefix' => 'risk-analysis', 'namespace' => 'RiskAnalysis'], function () {
        Route::group(['prefix' => 'security'], function () {
            Route::get('', 'SecurityController')
                ->name('inspector.risk_analysis.security.index');
            Route::match(['get', 'post'], 'create', 'SecurityController@create')
                ->name('inspector.risk_analysis.security.create');
            Route::match(['get', 'post'], 'update/{id}', 'SecurityController@update')
                ->name('inspector.risk_analysis.security.update');
        });
    });

    Route::group(['prefix' => 'assets', 'namespace' => 'Assets'], function () {
        Route::group(['prefix' => 'system-it'], function () {
            Route::get('', 'SystemItController')
                ->name('inspector.assets.system_it.index');
            Route::match(['get', 'post'], 'create', 'SystemItController@create')
                ->name('inspector.assets.system_it.create');
            Route::match(['get', 'post'], 'update/{id}', 'SystemItController@update')
                ->name('inspector.assets.system_it.update');
        });
    });

    Route::group(['prefix' => 'rcp', 'namespace' => 'RCP'], function () {
        Route::group(['prefix' => 'law-basic'], function () {
            Route::get('', 'LawBasicController')
                ->name('inspector.rcp.law_basic.index');
            Route::match(['get', 'post'], 'create', 'LawBasicController@create')
                ->name('inspector.rcp.law_basic.create');
            Route::match(['get', 'post'], 'update/{id}', 'LawBasicController@update')
                ->name('inspector.rcp.law_basic.update');
        });
        Route::group(['prefix' => 'activities'], function () {
            Route::get('', 'RCPActivityController')
                ->name('inspector.rcp.activity.index');
            Route::match(['get', 'post'], 'create', 'RCPActivityController@create')
                ->name('inspector.rcp.activity.create');
            Route::match(['get', 'post'], 'update/{id}', 'RCPActivityController@update')
                ->name('inspector.rcp.activity.update');
        });
        Route::group(['prefix' => 'data-retention'], function () {
            Route::get('', 'RCPDataRetentionController')
                ->name('inspector.rcp.data_retention.index');
            Route::match(['get', 'post'], 'create', 'RCPDataRetentionController@create')
                ->name('inspector.rcp.data_retention.create');
            Route::match(['get', 'post'], 'update/{id}', 'RCPDataRetentionController@update')
                ->name('inspector.rcp.data_retention.update');
        });
    });

    Route::group(['prefix' => 'api'], function () {
        Route::get('get-statuses', 'InspectorController@getStatuses');

        Route::group(['prefix' => 'tasks', 'namespace' => 'Tasks'], function () {
            Route::get('', 'TaskController@all')
                ->name('api.inspector.tasks.list');
            Route::delete('remove/{id}', 'TaskController@remove');
        });

        Route::group(['prefix' => 'employees', 'namespace' => 'Employees'], function () {
            Route::get('', 'EmployeeController@all')
                ->name('api.inspector.employees.list');
            Route::delete('remove/{id}', 'EmployeeController@remove');
        });

        Route::group(['prefix' => 'departments', 'namespace' => 'Departments'], function () {
            Route::get('', 'DepartmentController@all')
                ->name('api.inspector.departments.list');
            Route::delete('remove/{id}', 'DepartmentController@remove');
        });

        Route::group(['prefix' => 'newsletter', 'namespace' => 'Newsletter'], function () {
            Route::get('', 'NewsletterPostController@all')
                ->name('api.inspector.newsletter.list');
            Route::delete('remove/{id}', 'NewsletterPostController@remove');
        });

        Route::group(['prefix' => 'documents', 'namespace' => 'Documents'], function () {
            Route::get('', 'DocumentController@all')
                ->name('api.inspector.documents.list');
            Route::delete('remove/{id}', 'DocumentController@remove');
        });

        Route::group(['prefix' => 'applications', 'namespace' => 'Applications'], function () {
            Route::group(['prefix' => 'conclusions'], function () {
                Route::get('', 'ApplicationConclusionController@all')
                    ->name('api.inspector.applications.conclusions.list');
                Route::delete('remove/{id}', 'ApplicationConclusionController');
            });

            Route::group(['prefix' => 'issues'], function () {
                Route::get('', 'ApplicationIssueController@all')
                    ->name('api.inspector.applications.issues.list');
                Route::delete('remove/{id}', 'ApplicationIssueController@remove');
            });

            Route::group(['prefix' => 'incidents'], function () {
                Route::get('', 'ApplicationIncidentsController@all')
                    ->name('api.inspector.applications.incidents.list');
                Route::delete('remove/{id}', 'ApplicationIncidentsController@remove');
            });
        });

        Route::group(['prefix' => 'meetings', 'namespace' => 'Meetings'], function () {
            Route::get('', 'MeetingController@all')
                ->name('api.inspector.meetings.list');
            Route::delete('remove/{id}', 'MeetingController@remove');
            Route::get('get-participants', 'MeetingController@getParticipants');
        });

        Route::group(['prefix' => 'datasets', 'namespace' => 'Datasets'], function () {
            Route::get('', 'DatasetController@all')
                ->name('api.inspector.datasets.list');
            Route::delete('remove/{id}', 'DatasetController@remove');
        });

        Route::group(['prefix' => 'risk-analysis', 'namespace' => 'RiskAnalysis'], function () {
            Route::group(['prefix' => 'security'], function () {
                Route::get('', 'SecurityController@all')
                    ->name('api.inspector.risk_analysis.security.list');
                Route::delete('remove/{id}', 'SecurityController@remove');
            });
        });

        Route::group(['prefix' => 'assets', 'namespace' => 'Assets'], function () {
            Route::group(['prefix' => 'system-id'], function () {
                Route::get('', 'SystemItController@all')
                    ->name('api.inspector.assets.system_it.list');
                Route::delete('remove/{id}', 'SystemItController@remove');
            });
        });

        Route::group(['prefix' => 'rcp', 'namespace' => 'RCP'], function () {
           Route::group(['prefix' => 'law-basic'], function () {
               Route::get('', 'LawBasicController@all')
                   ->name('api.inspector.rcp.law_basic.list');
               Route::delete('remove/{id}', 'LawBasicController@remove');
           });
           Route::group(['prefix' => 'activities'], function () {
               Route::get('', 'RCPActivityController@all')
                   ->name('api.inspector.rcp.activity.list');
               Route::delete('remove/{id}', 'RCPActivityController@remove');
           });
           Route::group(['prefix' => 'data-retention'], function () {
               Route::get('', 'RCPDataRetentionController@all')
                   ->name('api.inspector.rcp.data_retention.list');
               Route::delete('remove/{id}', 'RCPDataRetentionController@remove');
           });
        });

    });
});
