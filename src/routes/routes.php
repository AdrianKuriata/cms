<?php

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth'], 'namespace' => 'Akuriatadev\Wordit\Controllers'], function () {
    // Dashboard
    Route::get('/', 'DashboardController@index')->name('wordit.admin.dashboard.index');

    // Repositories
    Route::group(['prefix' => 'repositiories'], function () {
        Route::get('/', 'RepositoryController@index')->name('wordit.admin.repositories.index');
    });

    // Core loaders and functions
    Route::group(['prefix' => 'core'], function () {
        Route::get('/repositories', 'RepositoryController@getRepositories')->name('wordit.admin.core.repositories');
        Route::post('/upgrade-all', 'RepositoryController@upgrade')->name('wordit.admin.core.upgrade');
    });

    // Users
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'UserController@index')->name('wordit.admin.user.index');
    });

    // Models
    if (!empty(config('wordit.models'))) {
        foreach (config('wordit.models') as $model) {
            $model = new $model['model'];

            Route::group(['prefix' => $model->getRouteName(), 'as' => 'wordit.admin.'], function () use ($model) {
                Route::get('/', 'ModelController@index')->name($model->getRouteName().'.index');

                Route::group(['prefix' => 'create'], function () use ($model) {
                    Route::get('/', 'ModelController@create')->name($model->getRouteName().'.create.get');
                    Route::post('/', 'ModelController@createStore')->name($model->getRouteName().'.create.post');
                });
            });
        }
    }
});
