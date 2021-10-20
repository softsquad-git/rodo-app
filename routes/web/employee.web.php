<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'employee', 'namespace' => 'Employee'], function () {
   Route::get('', 'EmployeeController')
       ->name('employee.index');

   Route::group(['prefix' => 'profile'], function () {
      Route::get('', 'ProfileController')
          ->name('employee.profile');
      Route::patch('update-avatar', 'ProfileController@updateAvatar')
          ->name('employee.update.avatar');
   });

   Route::group(['prefix' => 'applications', 'namespace' => 'Applications'], function () {
      Route::get('', 'ApplicationController')
          ->name('employee.applications.index');
      Route::get('issues', 'ApplicationIssueController')
          ->name('employee.applications.issues.index');
      Route::get('incidents', 'ApplicationIncidentsController')
          ->name('employee.applications.incidents.index');
      Route::get('conclusions', 'ApplicationConclusionController')
          ->name('employee.applications.conclusions.index');
   });

   Route::group(['prefix' => 'documents', 'namespace' => 'Documents'], function () {
       Route::get('', 'DocumentController')
           ->name('employee.documents.index');
   });

   Route::group(['prefix' => 'trainings', 'namespace' => 'Trainings'], function () {
      Route::get('', 'TrainingController')
          ->name('employee.trainings.index');
      Route::get('show/{id}', 'TrainingController@show')
          ->name('employee.trainings.show');
      Route::get('browser/{id}', 'TrainingController@browser')
          ->name('employee.trainings.browser');

      Route::group(['prefix' => 'tests'], function () {
          Route::get('', 'TestsController')
              ->name('employee.trainings.tests.index');
          Route::get('show/{id}', 'TestsController@show')
              ->name('employee.trainings.tests.show');
          Route::post('complete/{testId}', 'TestsController@completeTest')
              ->name('employee.trainings.tests.complete');
      });

      Route::group(['prefix' => 'certificates'], function () {
          Route::get('', 'CertificatesController')
              ->name('employee.trainings.certificates.index');
          Route::get('download/{id}', 'CertificatesController@download')
              ->name('employee.trainings.certificates.download');
      });
   });

   Route::group(['prefix' => 'permissions', 'namespace' => 'Permissions'], function () {
       Route::get('', 'PermissionController')
           ->name('employee.permissions.index');
   });

   Route::group(['prefix' => 'api'], function () {
       Route::group(['prefix' => 'applications', 'namespace' => 'Applications'], function () {

           Route::group(['prefix' => 'issues'], function () {
               Route::get('', 'ApplicationIssueController@all')
                   ->name('api.employee.applications.issues.list');
           });
           Route::group(['prefix' => 'incidents'], function () {
               Route::get('', 'ApplicationIncidentsController@all')
                   ->name('api.employee.applications.incidents.list');
           });
           Route::group(['prefix' => 'conclusions'], function () {
               Route::get('', 'ApplicationConclusionsController@all')
                   ->name('api.employee.applications.conclusions.list');
           });
       });

       Route::group(['prefix' => 'trainings', 'namespace' => 'Trainings'], function () {
           Route::get('', 'TrainingController@all')
               ->name('api.employee.trainings.list');

           Route::group(['prefix' => 'tests'], function () {
               Route::get('', 'TestsController@all')
                   ->name('api.employee.trainings.tests.list');
           });

           Route::group(['prefix' => 'certificates'], function () {
               Route::get('', 'CertificatesController@all')
                   ->name('api.employee.trainings.certificates.list');
           });
       });

       Route::group(['prefix' => 'documents', 'namespace' => 'Documents'], function () {
           Route::get('', 'DocumentController@all')
               ->name('api.employee.documents.list');
       });
   });
});
