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
        Route::get('/', 'UserController@index')->name('wordit.admin.users.index');

        Route::group(['prefix' => 'create', 'middleware' => 'can:create-user'], function () {
            Route::get('/', 'UserController@getCreate')->name('wordit.admin.users.create.get');
            Route::post('/', 'UserController@postCreate')->name('wordit.admin.users.create.post');
        });

        Route::group(['prefix' => 'update', 'middleware' => 'can:update-user'], function () {
            Route::get('/{id}', 'UserController@getUpdate')->name('wordit.admin.users.update.get');
            Route::post('/{id}', 'UserController@postUpdate')->name('wordit.admin.users.update.post');
        });

        Route::post('/delete/{id}', 'UserController@delete')->name('wordit.admin.users.delete');
    });

    // Groups
    Route::group(['prefix' => 'groups', 'middleware' => 'can:view-group'], function () {
        Route::get('/', 'GroupController@index')->name('wordit.admin.groups.index');

        Route::group(['prefix' => 'create', 'middleware' => 'can:create-group'], function () {
            Route::get('/', 'GroupController@getCreate')->name('wordit.admin.groups.create.get');
            Route::post('/', 'GroupController@postCreate')->name('wordit.admin.groups.create.post');
        });

        Route::group(['prefix' => 'update', 'middleware' => 'can:update-group'], function () {
            Route::get('/{id}', 'GroupController@getUpdate')->name('wordit.admin.groups.update.get');
            Route::post('/{id}', 'GroupController@postUpdate')->name('wordit.admin.groups.update.post');
        });

        Route::post('/delete/{id}', 'GroupController@delete')->name('wordit.admin.groups.delete');
    });
});

if (!empty(config('wordit.models'))) {
    foreach (config('wordit.models') as $model) {
        $model = new $model;

        if ($model->getController() != false) {
            Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth', 'can:view-admin']], function () use ($model) {
                Route::group(['prefix' => $model->getRouteName(), 'as' => 'wordit.admin.'], function () use ($model) {
                    Route::get('/', $model->getController() . '@index')->name($model->getRouteName().'.index');

                    Route::group(['prefix' => 'create'], function () use ($model) {
                        Route::get('/', $model->getController() . '@getCreate')->name($model->getRouteName().'.create.get');
                        Route::post('/', $model->getController() . '@postCreate')->name($model->getRouteName().'.create.post');
                    });

                    Route::group(['prefix' => 'update'], function () use ($model) {
                        Route::get('/{id}', $model->getController() . '@getUpdate')->name($model->getRouteName().'.update.get');
                        Route::post('/{id}', $model->getController() . '@postUpdate')->name($model->getRouteName().'.update.post');
                    });

                    Route::post('/delete/{id}', $model->getController() . '@delete')->name($model->getRouteName() . '.delete');
                });
            });
        } else {
            Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth', 'can:view-admin'], 'namespace' => 'Akuriatadev\Wordit\Controllers'], function () use ($model) {
                Route::group(['prefix' => $model->getRouteName(), 'as' => 'wordit.admin.'], function () use ($model) {
                    Route::get('/', 'ModelController@index')->name($model->getRouteName().'.index');

                    Route::group(['prefix' => 'create'], function () use ($model) {
                        Route::get('/', 'ModelController@getCreate')->name($model->getRouteName().'.create.get');
                        Route::post('/', 'ModelController@postCreate')->name($model->getRouteName().'.create.post');
                    });

                    Route::group(['prefix' => 'update'], function () use ($model) {
                        Route::get('/{id}', 'ModelController@getUpdate')->name($model->getRouteName().'.update.get');
                        Route::post('/{id}', 'ModelController@postUpdate')->name($model->getRouteName().'.update.post');
                    });

                    Route::post('/delete/{id}', 'ModelController@delete')->name($model->getRouteName() . '.delete');
                });
            });
        }
    }
}
