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

Route::group(['prefix' => 'register'], function () {
    Route::get('', 'LoginController@getRegister')->name('getRegister');
    Route::post('', 'LoginController@postRegister')->name('postRegister');
});

Route::get('/logout', 'LoginController@getLogout')->name('getLogout');

Route::group(['prefix' => '/', 'middleware' => ['checkunderconstruct']], function () {
    Route::get('', 'HomeController@getHome')->name('home');
    Route::prefix('/go')->group(function () {
        Route::get('{string}', 'LinkController@getRedirect')->name('getRedirect');
    });
    Route::group(['prefix' => 's3link', 'middleware' => 'checkunderconstruct'], function () {
        Route::get('/{slug}', 'S3ManageController@gotoS3Link')->name('gotoS3Link');
    });

    Route::middleware('countviewpost')->group(function() {
        Route::prefix('post/{id}/{slug}.html')->group(function () {
            Route::get('', 'PostController@getPost')->name('getPost');
        });
        Route::prefix('post/get-relate-post')->group(function () {
            Route::get('', 'PostController@getRelatePost')->name('getRelatePost');
        });
    });
    Route::prefix('page/{id}-{slug}.html')->group(function () {
        Route::get('', 'PageController@getPage')->name('getPage');
    });
    Route::prefix('category/{slug}-{id}.html')->group(function () {
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

    Route::post('/post/{post_id}/like', 'PostController@like')->name('post.like');
    Route::get('user-cp/{id}', 'HomeController@usercpPage')->name('user.cp')->middleware(['role:super-admin|admin|super-moderator|moderator|member']);
    Route::post('user-cp/{id}', 'HomeController@usercpPagePost')->name('user.cp.post')->middleware(['role:super-admin|admin|super-moderator|moderator|member']);
    Route::post('user-cp-delete/{id}', 'HomeController@usercpCommentsDelete')->name('user.cp.delete.post')->middleware(['role:super-admin|admin|super-moderator|moderator|member']);
});

Route::group(['prefix' => 'backend', 'middleware' => ['role:super-admin', 'checklogin', 'checkunderconstruct']], function () {
    Route::get('', function () {
        return view('backend.dashboard.index');
    })->name('dashboard');

    Route::group(['prefix' => 'user', 'middleware' => 'role:super-admin'], function () {
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
        Route::post('upgrade-vip/{id}', 'UserController@upgradeVip')
            ->name('upgradeVip');
        Route::post('downgrade-vip/{id}', 'UserController@downgradeVip')
        ->name('downgradeVip');
    });

    Route::group(['prefix' => 'category', 'middleware' => 'role:super-admin'], function () {
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

    Route::group(['prefix' => 'page', 'middleware' => 'role:super-admin'], function () {
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

    Route::group(['prefix' => 'menu', 'middleware' => 'role:super-admin'], function () {
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

    Route::group(['prefix' => 'ads', 'middleware' => 'role:super-admin'], function () {
        Route::get('', 'AdsController@getAll')->name('ads');
        Route::post('', 'AdsController@storeAll')->name('storeAds');
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('', 'SettingController@getIndex')->name('setting');
        Route::get('signature', 'SettingController@getSignScreen')->name('signature')->middleware('role:super-admin');
        Route::post('signature', 'SettingController@postSignature')->name('postSignature')->middleware('role:super-admin');
        Route::get('backend-credit', 'SettingController@getBackendCreditScreen')->name('backend-credit')->middleware('role:super-admin');
        Route::post('backend-credit', 'SettingController@postBackendCredit')->name('postBackendCredit')->middleware('role:super-admin');
        Route::get('backend-column', 'SettingController@getBackendColumnScreen')->name('backend-column')->middleware('role:super-admin');
        Route::post('backend-column', 'SettingController@postBackendColumn')->name('postBackendColumn')->middleware('role:super-admin');
        Route::get('frontend-column', 'SettingController@getFrontendColumnScreen')->name('frontend-column')->middleware('role:super-admin');
        Route::post('frontend-column', 'SettingController@postFrontendColumn')->name('postFrontendColumn')->middleware('role:super-admin');
        Route::get('social', 'SettingController@getSocialScreen')->name('social')->middleware('role:super-admin');
        Route::post('social', 'SettingController@postSocial')->name('postSocial')->middleware('role:super-admin');
        Route::get('code-example', 'SettingController@getCodeExampleScreen')->name('code-example')->middleware('role:super-admin');
        Route::get('report-list', 'ReportController@getReportScreen')->name('report-list')->middleware('role:super-admin');
        Route::get('deleteReport/{id}', 'ReportController@deleteReport')->name('deleteReport')->middleware('role:super-admin');
        Route::get('deleteAllReport', 'ReportController@deleteAllReport')->name('deleteAllReport')->middleware('role:super-admin');
        Route::get('under-construct', 'SettingController@underConstruct')->name('underConstruct')->middleware('role:super-admin');
        Route::post('under-construct', 'SettingController@postunderConstruct')->name('postunderConstruct')->middleware('role:super-admin');
        Route::get('search-data', 'SettingController@getSearchData')->name('getSearchData')->middleware('role:super-admin');
        Route::get('delete/search-data/{id}', 'SettingController@deleteSearchData')->name('deleteSearchData')->middleware('role:super-admin');
        Route::get('reset-search-data', 'SettingController@resetSearchData')->name('resetSearchData')->middleware('role:super-admin');
        Route::get('popup-setting', 'SettingController@popupSetting')->name('popupSetting')->middleware('role:super-admin');
        Route::post('popup-setting', 'SettingController@postpopupSetting')->name('postpopupSetting')->middleware('role:super-admin');
        Route::get('hashtag-setting', 'HashTagController@getAllHashTagSetting')->name('getAllHashTagSetting')->middleware('role:super-admin');
        Route::get('deleteHashtag/{id}', 'HashTagController@deleteHashtag')->name('deleteHashtag')->middleware('role:super-admin');
        Route::get('donate-setting', 'SettingController@donateSetting')->name('donateSetting')->middleware('role:super-admin');
        Route::get('donate-list-course', 'SettingController@donateCourseList')->name('donateCourseList')->middleware('role:super-admin');
        Route::get('donate-list-branchcourse', 'SettingController@donateBranchCourse')->name('donateBranchCourse')->middleware('role:super-admin');
        Route::get('donate-list-member', 'SettingController@donateMember')->name('donateMember')->middleware('role:super-admin');
        Route::post('update-donate-info', 'SettingController@updateDonateInfo')->name('updateDonateInfo')->middleware('role:super-admin');
        Route::get('add-donate-course', 'SettingController@addDonateCourse')->name('addDonateCourse')->middleware('role:super-admin');
        Route::post('add-donate-course', 'SettingController@postaddDonateCourse')->name('postaddDonateCourse')->middleware('role:super-admin');
        Route::get('delete-donate-course/{id}', 'SettingController@deleteDonateCourse')->name('deleteDonateCourse')->middleware('role:super-admin');
        Route::get('edit-donate-course/{id}', 'SettingController@editDonateCourse')->name('editDonateCourse')->middleware('role:super-admin');
        Route::post('edit-donate-course/{id}', 'SettingController@posteditDonateCourse')->name('posteditDonateCourse')->middleware('role:super-admin');
        Route::get('add-branch-course', 'SettingController@addDonateBranchCourse')->name('addDonateBranchCourse')->middleware('role:super-admin');
        Route::post('add-branch-course', 'SettingController@postaddDonateBranchCourse')->name('postaddDonateBranchCourse')->middleware('role:super-admin');
        Route::get('delete-branch-course/{id}', 'SettingController@deleteDonateBranchCourse')->name('deleteDonateBranchCourse')->middleware('role:super-admin');
        Route::get('edit-branch-course/{id}', 'SettingController@editDonateBranchCourse')->name('editDonateBranchCourse')->middleware('role:super-admin');
        Route::post('edit-branch-course/{id}', 'SettingController@posteditDonateBranchCourse')->name('posteditDonateBranchCourse')->middleware('role:super-admin');
        Route::get('request-movive', 'SettingController@requestHD')->name('requestHD')->middleware('checkmod');
        Route::get('delete-requestHD/{id}', 'SettingController@deleteRequestHD')->name('delete-requestHD')->middleware('checkmod');
    });

    Route::group(['prefix' => 'pokemon', 'middleware' => 'role:super-admin'], function () {
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

    Route::group(['prefix' => 'log', 'middleware' => 'role:super-admin'], function () {
        Route::get('', 'LogController@getAll')->name('log');
        Route::get('deleteAllLog', 'LogController@deleteAllLog')->name('deleteAllLog');
    });

    Route::group(['prefix' => 's3-manage', 'middleware' => 'role:super-admin'], function () {
        Route::post('', 'S3ManageController@uploadS3')->name('uploads3post');
        Route::get('/delete/{id}', 'S3ManageController@deleteS3Link')->name('deleteS3Link');
    });

    Route::group(['prefix' => 'filter', 'middleware' => 'role:super-admin'], function () {
        Route::get('administrator','UserController@filterAdmin')->name('filterAdmin');
    });
});

Route::group(['prefix' => 'admin-cp-2612', 'middleware' => ['role:super-admin', 'checklogin', 'checkunderconstruct']], function () {
    Route::get('', function () {
        return view('admin-v2.dashboard.index');
    })->name('admin.v2.dashboard');

    Route::group(['prefix' => 'user', 'middleware' => 'role:super-admin'], function () {
        Route::get('', 'adminV2\UserControllerV2@getAll')->name('admin.v2.user');
        Route::get('/{id}', 'adminV2\UserControllerV2@getUser')->name('admin.v2.get_user');
        Route::post('/avatar/{id}', 'adminV2\UserControllerV2@updateAvatarUser')->name('admin.v2.update_avatar_user');
        Route::post('/{id}', 'adminV2\UserControllerV2@updateUser')->name('admin.v2.update_user');
    });
});

Route::get('nganluong', function () {
    return view('home/index');
});

Route::post('nganluong', 'NganLuongController@postNganluong')->name('postNganluong');
