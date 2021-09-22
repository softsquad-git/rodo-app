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
        });

    });
});
