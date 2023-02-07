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

Route::group(['prefix' => 'login'], function () {
    Route::get('', 'LoginController@getLogin')->name('getLogin');
    Route::post('', 'LoginController@postLogin')->name('postLogin');
});

Route::get('/logout', 'LoginController@getLogout')->name('getLogout');

Route::group(['prefix' => '/', 'middleware' => 'checkunderconstruct'], function () {
    Route::get('', 'HomeController@getHome')->name('home');
    Route::prefix('/go')->group(function () {
        Route::get('{string}', 'LinkController@getRedirect')->name('getRedirect');    
    });
    Route::group(['prefix' => 's3link', 'middleware' => 'checkunderconstruct'], function () {
        Route::get('/{slug}', 'S3ManageController@gotoS3Link')->name('gotoS3Link');
    });

    Route::middleware('countviewpost')->group(function() {
        Route::prefix('post/{id}/{slug}')->group(function () {
            Route::get('', 'PostController@getPost')->name('getPost');
        });
        Route::prefix('post/get-relate-post')->group(function () {
            Route::get('', 'PostController@getRelatePost')->name('getRelatePost');
        });
    });
    Route::prefix('page/{id}/{slug}')->group(function () {
        Route::get('', 'PageController@getPage')->name('getPage');
    });
    Route::prefix('category/{slug}/{id}')->group(function () {
        Route::get('', 'CategoryController@getCategory')->name('getCategory');
    });
    Route::get('search', 'PostController@getSearch')->name('search');
    Route::get('hashtag', 'PostController@getHashtag')->name('hashtag');
    Route::get('donate', 'HomeController@getDonatePage')->name('getDonatePage');
    Route::get('online', 'HomeController@getDonatePage')->name('getDonatePage');

    Route::post('requestHDFront','SettingController@requestHDFront')->name('requestHDFront');

    Route::prefix('report')->group(function () {
        Route::get('', 'ReportController@index')->name('report');
    });
});

Route::group(['prefix' => 'backend', 'middleware' => ['checklogin', 'checkunderconstruct']], function () {
    Route::get('', function () {
        return view('backend.dashboard.index');
    })->name('dashboard');

    Route::group(['prefix' => 'user', 'middleware' => 'checkadmin'], function () {
        Route::get('', 'UserController@getAll')->name('user');
        Route::get('edit/{id}', 'UserController@editUser')
            ->where(['id' => '[0-9]+'])
            ->name('editUser');
        Route::post('update/{id}', 'UserController@updateUser')
            ->where(['id' => '[0-9]+'])
            ->name('updateUser');
        Route::get('delete/{id}', 'UserController@deleteUser')
            ->where(['id' => '[0-9]+'])
            ->name('deleteUser');
        Route::get('add', 'UserController@addUser')
            ->name('addUser');
        Route::post('add', 'UserController@postaddUser')
            ->name('postaddUser');
        Route::get('filter', 'UserController@filterUser')
            ->name('filterUser');
        Route::post('filter', 'UserController@postfilterUser')
            ->name('postfilterUser');
        Route::get('find', 'UserController@searchUsers')
            ->name('findUser');
    });

    Route::group(['prefix' => 'category', 'middleware' => 'checkadmin'], function () {
        Route::get('', 'CategoryController@getAll')->name('category');
        Route::get('edit/{id}', 'CategoryController@editCategory')
            ->where(['id' => '[0-9]+'])
            ->name('editCategory');
        Route::get('add', 'CategoryController@addCategory')
            ->name('addCategory');
        Route::post('add', 'CategoryController@postaddCategory')
            ->name('postaddCategory');
        Route::get('edit/{id}', 'CategoryController@editCategory')
            ->where(['id' => '[0-9]+'])
            ->name('editCategory');
        Route::post('edit/{id}', 'CategoryController@posteditCategory')
            ->name('posteditCategory');
        Route::get('delete/{id}', 'CategoryController@deleteCategory')
            ->where(['id' => '[0-9]+'])
            ->name('deleteCategory');
        Route::post('add-moderator', 'CategoryController@addModerator')
            ->name('postaddModerator');
        Route::get('remove-moderator/{id}', 'CategoryController@removeModerator')
            ->name('removeModerator');
    });

    Route::prefix('/post')->group(function () {
        Route::get('', 'PostController@getAll')->name('post');
        Route::get('delete/{id}', 'PostController@deletePost')
            ->where(['id' => '[0-9]+'])
            ->name('deletePost');
        Route::get('add', 'PostController@addPost')
            ->name('addPost');
        Route::post('add', 'PostController@postaddPost')
            ->name('postaddPost');
        Route::get('edit/{id}', 'PostController@editPost')
            ->where(['id' => '[0-9]+'])
            ->name('editPost');
        Route::post('edit/{id}', 'PostController@posteditPost')
            ->where(['id' => '[0-9]+'])
            ->name('posteditPost');
        Route::get('filter', 'PostController@filterPost')
            ->name('filterPost');
        Route::post('filter', 'PostController@postfilterPost')
            ->name('postfilterPost');
        Route::get('filterHashTag', 'HashTagController@filterHashTag')
            ->name('filterHashTag');
        Route::get('removeHashTag', 'HashTagController@removeHashTag')
            ->name('removeHashTag');
    });

    Route::group(['prefix' => 'page', 'middleware' => 'checkadmin'], function () {
        Route::get('', 'PageController@getAll')->name('page');
        Route::get('add', 'PageController@addPage')->name('addPage');
        Route::post('add', 'PageController@postaddPage')->name('postaddPage');
        Route::get('edit/{id}', 'PageController@editPage')
            ->where(['id' => '[0-9]+'])
            ->name('editPage');
        Route::post('edit/{id}', 'PageController@posteditPage')
            ->where(['id' => '[0-9]+'])
            ->name('posteditPage');
        Route::get('delete/{id}', 'PageController@deletePage')
            ->where(['id' => '[0-9]+'])
            ->name('deletePage');
        Route::get('filter', 'PageController@filterPage')
            ->name('filterPage');
        Route::post('filter', 'PageController@postfilterPage')
            ->name('postfilterPage');
    });

    Route::group(['prefix' => 'menu', 'middleware' => 'checkadmin'], function () {
        Route::get('', 'MenuController@menuConfig')->name('menu');
        Route::post('', 'MenuController@postaddcategorymenu')->name('postaddcategorymenu');
        Route::post('add', 'MenuController@postaddmenucustom')->name('postaddmenucustom');
        Route::get('delete/{id}', 'MenuController@deletemenu')->name('deletemenu');
    });

    Route::prefix('/links')->group(function () {
        Route::get('', 'LinkController@getlLinkConfig')->name('link');
        Route::post('update-service', 'LinkController@updateService')->name('updateService');
        Route::post('store-service', 'LinkController@storeService')->name('storeService');
        Route::get('delete-service/{id}', 'LinkController@deleteService')->name('deleteService');
        Route::post('create-service', 'LinkController@createLink')->name('createLink');
        Route::get('delete-link/{id}', 'LinkController@deleteLink')->name('deleteLink');
    });

    Route::group(['prefix' => 'ads', 'middleware' => 'checkadmin'], function () {
        Route::get('', 'AdsController@getAll')->name('ads');
        Route::post('', 'AdsController@storeAll')->name('storeAds');
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('', 'SettingController@getIndex')->name('setting');
        Route::get('signature', 'SettingController@getSignScreen')->name('signature')->middleware('checkadmin');
        Route::post('signature', 'SettingController@postSignature')->name('postSignature')->middleware('checkadmin');
        Route::get('backend-credit', 'SettingController@getBackendCreditScreen')->name('backend-credit')->middleware('checkadmin');
        Route::post('backend-credit', 'SettingController@postBackendCredit')->name('postBackendCredit')->middleware('checkadmin');
        Route::get('backend-column', 'SettingController@getBackendColumnScreen')->name('backend-column')->middleware('checkadmin');
        Route::post('backend-column', 'SettingController@postBackendColumn')->name('postBackendColumn')->middleware('checkadmin');
        Route::get('frontend-column', 'SettingController@getFrontendColumnScreen')->name('frontend-column')->middleware('checkadmin');
        Route::post('frontend-column', 'SettingController@postFrontendColumn')->name('postFrontendColumn')->middleware('checkadmin');
        Route::get('social', 'SettingController@getSocialScreen')->name('social')->middleware('checkadmin');
        Route::post('social', 'SettingController@postSocial')->name('postSocial')->middleware('checkadmin');
        Route::get('code-example', 'SettingController@getCodeExampleScreen')->name('code-example')->middleware('checkadmin');
        Route::get('report-list', 'ReportController@getReportScreen')->name('report-list')->middleware('checkadmin');
        Route::get('deleteReport/{id}', 'ReportController@deleteReport')->name('deleteReport')->middleware('checkadmin');
        Route::get('deleteAllReport', 'ReportController@deleteAllReport')->name('deleteAllReport')->middleware('checkadmin');
        Route::get('under-construct', 'SettingController@underConstruct')->name('underConstruct')->middleware('checkadmin');
        Route::post('under-construct', 'SettingController@postunderConstruct')->name('postunderConstruct')->middleware('checkadmin');
        Route::get('search-data', 'SettingController@getSearchData')->name('getSearchData')->middleware('checkadmin');
        Route::get('delete/search-data/{id}', 'SettingController@deleteSearchData')->name('deleteSearchData')->middleware('checkadmin');
        Route::get('reset-search-data', 'SettingController@resetSearchData')->name('resetSearchData')->middleware('checkadmin');
        Route::get('popup-setting', 'SettingController@popupSetting')->name('popupSetting')->middleware('checkadmin');
        Route::post('popup-setting', 'SettingController@postpopupSetting')->name('postpopupSetting')->middleware('checkadmin');
        Route::get('hashtag-setting', 'HashTagController@getAllHashTagSetting')->name('getAllHashTagSetting')->middleware('checkadmin');
        Route::get('deleteHashtag/{id}', 'HashTagController@deleteHashtag')->name('deleteHashtag')->middleware('checkadmin');
        Route::get('donate-setting', 'SettingController@donateSetting')->name('donateSetting')->middleware('checkadmin');
        Route::get('donate-list-course', 'SettingController@donateCourseList')->name('donateCourseList')->middleware('checkadmin');
        Route::get('donate-list-branchcourse', 'SettingController@donateBranchCourse')->name('donateBranchCourse')->middleware('checkadmin');
        Route::get('donate-list-member', 'SettingController@donateMember')->name('donateMember')->middleware('checkadmin');
        Route::post('update-donate-info', 'SettingController@updateDonateInfo')->name('updateDonateInfo')->middleware('checkadmin');
        Route::get('add-donate-course', 'SettingController@addDonateCourse')->name('addDonateCourse')->middleware('checkadmin');
        Route::post('add-donate-course', 'SettingController@postaddDonateCourse')->name('postaddDonateCourse')->middleware('checkadmin');
        Route::get('delete-donate-course/{id}', 'SettingController@deleteDonateCourse')->name('deleteDonateCourse')->middleware('checkadmin');
        Route::get('edit-donate-course/{id}', 'SettingController@editDonateCourse')->name('editDonateCourse')->middleware('checkadmin');
        Route::post('edit-donate-course/{id}', 'SettingController@posteditDonateCourse')->name('posteditDonateCourse')->middleware('checkadmin');
        Route::get('add-branch-course', 'SettingController@addDonateBranchCourse')->name('addDonateBranchCourse')->middleware('checkadmin');
        Route::post('add-branch-course', 'SettingController@postaddDonateBranchCourse')->name('postaddDonateBranchCourse')->middleware('checkadmin');
        Route::get('delete-branch-course/{id}', 'SettingController@deleteDonateBranchCourse')->name('deleteDonateBranchCourse')->middleware('checkadmin');
        Route::get('edit-branch-course/{id}', 'SettingController@editDonateBranchCourse')->name('editDonateBranchCourse')->middleware('checkadmin');
        Route::post('edit-branch-course/{id}', 'SettingController@posteditDonateBranchCourse')->name('posteditDonateBranchCourse')->middleware('checkadmin');
        Route::get('request-movive', 'SettingController@requestHD')->name('requestHD')->middleware('checkmod');
        Route::get('delete-requestHD/{id}', 'SettingController@deleteRequestHD')->name('delete-requestHD')->middleware('checkmod');
    });

    Route::group(['prefix' => 'pokemon', 'middleware' => 'checkadmin'], function () {
        Route::get('', 'V1\PokemonController@indexView')->name('indexViewPokemon');
        Route::get('add', 'V1\PokemonController@addView')->name('addViewPokemon');
        Route::post('add-submit', 'V1\PokemonController@addSubmit')->name('addSubmit');
        Route::get('edit/{id}', 'V1\PokemonController@editView')
            ->where(['id' => '[0-9]+'])
            ->name('editViewPokemon');
        Route::post('edit/{id}', 'V1\PokemonController@editSubmit')
            ->where(['id' => '[0-9]+'])
            ->name('editSubmit');
        Route::get('delete/{id}', 'V1\PokemonController@deleteRom')
            ->where(['id' => '[0-9]+'])
            ->name('deleteRom');
    });

    Route::group(['prefix' => 'log', 'middleware' => 'checkadmin'], function () {
        Route::get('', 'LogController@getAll')->name('log');
        Route::get('deleteAllLog', 'LogController@deleteAllLog')->name('deleteAllLog');
    });
    
    Route::group(['prefix' => 's3-manage', 'middleware' => 'checkadmin'], function () {
        Route::post('', 'S3ManageController@uploadS3')->name('uploads3post');
        Route::get('/delete/{id}', 'S3ManageController@deleteS3Link')->name('deleteS3Link');
    });

    Route::group(['prefix' => 'filter', 'middleware' => 'checkadmin'], function () {
        Route::get('administrator','UserController@filterAdmin')->name('filterAdmin');
    });
});

Route::get('nganluong', function () {
    return view('home/index');
});

Route::post('nganluong', 'NganLuongController@postNganluong')->name('postNganluong');
