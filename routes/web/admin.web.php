<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'administration', 'namespace' => 'Admin'], function () {
    Route::get('', 'AdminController')
        ->name('admin.index');

    Route::group(['prefix' => 'profile'], function () {
        Route::get('', 'ProfileController')
            ->name('admin.profile');
        Route::patch('update-avatar', 'ProfileController@updateAvatar')
            ->name('admin.update.avatar');
        Route::patch('update-basic-data', 'ProfileController@updateBasicData')
            ->name('admin.update.basic_data');
        Route::patch('update-password', 'ProfileController@updatePassword')
            ->name('admin.update.password');
    });

    Route::group(['prefix' => 'settings', 'namespace' => 'Settings'], function () {
        Route::get('', 'SettingController')
            ->name('admin.settings.index');
    });

    Route::group(['prefix' => 'logs', 'namespace' => 'Logs'], function () {
        Route::get('', 'LogController@index')
            ->name('admin.logs.index');
        Route::delete('remove/{id}', 'LogController@remove')
            ->name('admin.logs.remove');
        Route::get('download', 'LogController@download')
            ->name('admin.logs.download');
    });

    Route::group(['prefix' => 'users', 'namespace' => 'Users'], function () {
        Route::get('', 'UserController')
            ->name('admin.users.index');
        Route::match(['get', 'post'], 'create', 'UserController@create')
            ->name('admin.users.create');
        Route::match(['get', 'post'], 'update/{id}', 'UserController@update')
            ->name('admin.users.update');
    });

    Route::group(['prefix' => 'clients', 'namespace' => 'Clients'], function () {
        Route::get('', 'ClientController')
            ->name('admin.clients.index');
        Route::match(['get', 'post'], 'create', 'ClientController@create')
            ->name('admin.clients.create');
        Route::match(['get', 'post'], 'update/{id}', 'ClientController@update')
            ->name('admin.clients.update');
    });

    Route::group(['prefix' => 'trainings', 'namespace' => 'Trainings'], function () {
        Route::get('', 'TrainingController')
            ->name('admin.trainings.index');
        Route::match(['get', 'post'], 'create', 'TrainingController@create')
            ->name('admin.trainings.create');
        Route::match(['get', 'post'], 'update/{id}', 'TrainingController@update')
            ->name('admin.trainings.update');

        Route::group(['prefix' => 'groups'], function () {
            Route::get('', 'TrainingGroupController')
                ->name('admin.trainings.groups.index');
            Route::match(['get', 'post'], 'create', 'TrainingGroupController@create')
                ->name('admin.trainings.groups.create');
            Route::match(['get', 'post'], 'update/{id}', 'TrainingGroupController@update')
                ->name('admin.trainings.groups.update');
        });

        Route::group(['prefix' => 'tests', 'namespace' => 'Tests'], function () {
            Route::get('', 'TestController')
                ->name('admin.trainings.tests.index');
            Route::match(['get', 'post'], 'create', 'TestController@create')
                ->name('admin.trainings.tests.create');
            Route::match(['get', 'post'], 'update/{id}', 'TestController@update')
                ->name('admin.trainings.tests.update');

            Route::group(['prefix' => 'questions'], function () {
                Route::get('','TestQuestionController')
                    ->name('admin.trainings.tests.questions.index');
                Route::get('create', 'TestQuestionController@create')
                    ->name('admin.trainings.test.questions.create');
            });
        });
    });

    Route::group(['prefix' => 'certificates', 'namespace' => 'Certificates'], function () {
        Route::get('', 'CertificateController')
            ->name('admin.certificates.index');
        Route::delete('remove/{id}', 'CertificateController@remove')
            ->name('admin.certificates.remove');

        Route::group(['prefix' => 'patters'], function () {
            Route::get('', 'CertificatePattersController')
                ->name('admin.certificates.patters.index');
            Route::match(['get', 'post'], 'create', 'CertificatePattersController@create')
                ->name('admin.certificates.patters.create');
            Route::match(['get', 'post'], 'update/{id}', 'CertificatePattersController@update')
                ->name('admin.certificates.patters.update');
        });
    });

    Route::group(['prefix' => 'roles', 'namespace' => 'Roles'], function () {
        Route::get('', 'RoleController')
            ->name('admin.roles.index');
        Route::match(['get', 'post'], 'create', 'RoleController@create')
            ->name('admin.roles.create');
        Route::match(['get', 'post'], 'update/{id}', 'RoleController@update')
            ->name('admin.roles.update');
    });

    Route::group(['prefix' => 'invoices', 'namespace' => 'Invoices'], function () {
        Route::get('', 'InvoiceController')
            ->name('admin.invoices.index');

        Route::group(['prefix' => 'settings'], function () {
            Route::get('', 'InvoiceSettingsController')
                ->name('admin.invoices.settings.index');
        });
    });

    Route::group(['prefix' => 'api'], function () {
        Route::get('get-statuses', 'AdminController@getStatuses');

        Route::group(['prefix' => 'settings', 'namespace' => 'Settings'], function () {
            Route::get('', 'SettingController@getSettingsList')
                ->name('api.admin.settings.list');

            Route::group(['prefix' => 'status'], function () {
                Route::get('', 'StatusController@all')
                    ->name('api.admin.settings.status.list');
                Route::get('find', 'StatusController@find')
                    ->name('api.admin.settings.status.find');
                Route::post('create', 'StatusController@create')
                    ->name('api.admin.settings.status.create');
                Route::patch('update', 'StatusController@update')
                    ->name('api.admin.settings.status.update');
                Route::delete('remove', 'StatusController@remove')
                    ->name('api.admin.settings.status.remove');
            });

            Route::group(['prefix' => 'types'], function () {
                Route::get('', 'TypeController@all')
                    ->name('api.admin.settings.types.list');
                Route::get('find', 'TypeController@find')
                    ->name('api.admin.settings.types.find');
                Route::post('create', 'TypeController@create')
                    ->name('api.admin.settings.types.create');
                Route::patch('update', 'TypeController@update')
                    ->name('api.admin.settings.types.update');
                Route::delete('remove', 'TypeController@remove')
                    ->name('api.admin.settings.types.remove');
            });
        });

        Route::group(['prefix' => 'clients', 'namespace' => 'Clients'], function () {
            Route::get('', 'ClientController@all')
                ->name('api.admin.clients.list');
            Route::delete('remove/{id}', 'ClientController@remove');
            Route::patch('archive/{id}', 'ClientController@archive');
        });

        Route::group(['prefix' => 'users', 'namespace' => 'Users'], function () {
            Route::get('', 'UserController@all')
                ->name('api.admin.users.list');
            Route::delete('remove/{id}', 'UserController@remove');
        });

        Route::group(['prefix' => 'trainings', 'namespace' => 'Trainings'], function () {
            Route::get('', 'TrainingController@all')
                ->name('api.admin.trainings.list');
            Route::delete('remove/{id}', 'TrainingController@remove');

            Route::group(['prefix' => 'groups'], function () {
                Route::get('', 'TrainingGroupController@all')
                    ->name('api.admin.trainings.groups.list');
                Route::delete('remove/{id}', 'TrainingGroupController@remove');
            });

            Route::group(['prefix' => 'tests', 'namespace' => 'Tests'], function () {
                Route::get('', 'TestController@all')
                    ->name('api.admin.trainings.tests.list');
                Route::delete('remove/{id}', 'TestController@remove');

                Route::group(['prefix' => 'questions'], function () {
                    Route::get('', 'TestQuestionController@all')
                        ->name('api.admin.trainings.tests.questions.list');
                    Route::get('find/{id}', 'TestQuestionController@find');
                    Route::post('create', 'TestQuestionController@create')
                        ->name('api.admin.trainings.tests.questions.create');
                    Route::put('update/{id}', 'TestQuestionController@update');
                    Route::delete('remove/{id}', 'TestQuestionController@remove');
                });
            });
        });

        Route::group(['prefix' => 'certificates', 'namespace' => 'Certificates'], function () {
            Route::get('', 'CertificateController@all')
                ->name('api.admin.certificates.list');
            Route::delete('remove/{id}', 'CertificateController@remove');

            Route::group(['prefix' => 'patters'], function () {
                Route::get('', 'CertificatePattersController@all')
                    ->name('api.admin.certificates.patters.list');
                Route::delete('remove/{id}', 'CertificatePattersController@remove');
            });
        });

        Route::group(['prefix' => 'roles', 'namespace' => 'Roles'], function () {
            Route::get('', 'RoleController@all')
                ->name('api.admin.roles.list');
            Route::delete('remove/{id}', 'RoleController@remove');
        });

        Route::group(['prefix' => 'invoices', 'namespace' => 'Invoices'], function () {
            Route::get('', 'InvoiceController@all')
                ->name('api.admin.invoices.list');

            Route::group(['prefix' => 'settings'], function () {
                Route::get('', 'InvoiceSettingsController@all')
                    ->name('api.admin.invoices.settings.list');
                Route::patch('update/{id}', 'InvoiceSettingsController@update');
            });
        });
    });
});
