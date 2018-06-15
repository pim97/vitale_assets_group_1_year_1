<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    //API
    Route::get('/api/assets', 'Api\AssetsAPIController@index');
    Route::get('/api/assets/{asset}', 'Api\AssetsAPIController@show');

    Route::get('/api/breachlocations', 'Api\BreachLocationsAPIController@index');
    Route::get('/api/breachlocations/{breachLocation}', 'Api\BreachLocationsAPIController@show');

    Route::get('/api/categories', 'Api\CategoriesAPIController@index');
    Route::get('/api/categories/{category}', 'Api\CategoriesAPIController@show');

    //Assets
    Route::resource('assets', 'AssetsController', ['except' => ['show']]);
    Route::get('/assets/{id}', 'AssetsController@show')->name('assets.show')->where('id', '[0-9]+');
    Route::get('/assets/json', 'AssetsController@json')->name('assetsjson');
    Route::get('/assets/delete/{id}', 'AssetsController@delete')->name('assets.delete');
    Route::get('/assets/floatscenarios', 'AssetsController@assetFloatScenarios')->name('assets.floatscenarios');

    //Breachlocations
    Route::get('/breaches/delete/{breach}', 'BreachLocationsController@delete')->name('breaches.delete');

    //Categories
    Route::resource('categories', 'CategoriesController', ['except' => ['show']]);
    Route::get('/categories/{id}', 'CategoriesController@show')->name('categories.show')->where('id', '[0-9]+');
    Route::get('/categories/delete/{category}', 'CategoriesController@delete')->name('categories.delete');
    Route::get('/categories/search', 'CategoriesController@search')->name('categories.search');
    Route::get('/categories/threshold', 'CategoriesController@getThresholdByAssetId')->name('categories.threshold');

    //Dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    //Loadlevels
    Route::get('/loadlevels/delete/{loadlevel}', 'LoadLevelsController@delete')->name('loadlevels.delete');

    //Map
    Route::get('/map', function () {
        return view('map');
    })->name('map');

    //News
    Route::get('/news/delete/{id}', 'NewsController@delete')->name('news.delete');

    //Scenarios
    Route::get('/scenarios/delete/{id}', 'ScenariosController@destroy')->name('scenario.delete');
    Route::get('/scenarios/getDataTable', 'ScenariosController@getDataTable');

    //Users
    Route::get('/users/delete/{user}', 'UsersController@delete')->name('users.delete');

    //Roles
    Route::get('/roles/delete/{role}', 'RolesController@delete')->name('roles.delete');

    //Users avatar
    Route::get('/users/avatar', 'AvatarController@index')->name('users.avatar');
    Route::post('/users/avatar', 'AvatarController@store');
    Route::get('/users/avatar/{id}', ['uses' => 'AvatarController@update', 'as' => 'users.avatar.update']);

    //Logbook
    Route::get('/logbook/revert/{id}', ['uses' => 'LogbookController@revert', 'as' => 'logbook.action.revert']);
    Route::get('/logbook/delete/{id}', ['uses' => 'LogbookController@remove', 'as' => 'logbook.action.delete']);

    /*
     * Resources
    */
    Route::resources([
        'scenarios' => 'ScenariosController',
        'users' => 'UsersController',
        'roles' => 'RolesController',
        'breaches' => 'BreachLocationsController',
        'maps' => 'MapsController',
        'news' => 'NewsController',
        'loadlevels' => 'LoadLevelsController',
        'logbook' => 'LogbookController'
    ]);
});
