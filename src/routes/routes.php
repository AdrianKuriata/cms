<?php

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth', 'can:view-admin'], 'namespace' => 'Akuriatadev\Wordit\Controllers'], function () {
    // Dashboard
    Route::get('/', 'DashboardController@index')->name('wordit.admin.dashboard.index');

    // Repositories
    Route::group(['prefix' => 'repositiories'], function () {
        Route::get('/', 'RepositoryController@index')->name('wordit.admin.repositories.index');
    });

    // Core loaders and functions
    Route::group(['prefix' => 'core'], function () {
        Route::get('/check', 'CoreController@checkCore')->name('wordit.admin.core.check');
        Route::get('/upgrade', 'CoreController@upgradeCore')->name('wordit.admin.core.upgrade');
        Route::get('/upgrade-log', 'CoreController@upgradeLog')->name('wordit.admin.core.upgrade.log');

        Route::group(['prefix' => 'system'], function () {

        });
    });

    // Repositories
    // Route::group(['prefix' => 'repositories'], function () {
    //     Route::get('/', 'RepositoryController@getRepositories')->name('wordit.admin.core.repositories');
    //     Route::post('/upgrade-all', 'RepositoryController@upgrade')->name('wordit.admin.core.upgrade');
    // });

    // Users
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'UserController@index')->name('wordit.admin.user.index');
    });

    // Groups
    Route::group(['prefix' => 'groups', 'middleware' => 'can:view-group'], function () {
        Route::get('/', 'GroupController@index')->name('wordit.admin.groups.index');

        Route::group(['prefix' => 'create', 'middleware' => 'can:create-group'], function () {
            Route::get('/', 'GroupController@getCreate')->name('wordit.admin.groups.create.get');
            Route::post('/', 'GroupController@postCreate')->name('wordit.admin.groups.create.post');
        });
    });

    // Models
    if (!empty(config('wordit.models'))) {
        foreach (config('wordit.models') as $model) {
            $model = new $model;

            Route::group(['prefix' => $model->getRouteName(), 'as' => 'wordit.admin.'], function () use ($model) {
                Route::get('/', 'ModelController@index')->name($model->getRouteName().'.index');

                Route::group(['prefix' => 'create'], function () use ($model) {
                    Route::get('/', 'ModelController@getCreate')->name($model->getRouteName().'.create.get');
                    Route::post('/', 'ModelController@postCreate')->name($model->getRouteName().'.create.post');
                });
            });
        }
    }
});
