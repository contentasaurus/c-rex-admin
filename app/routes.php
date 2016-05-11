<?php

namespace puffin;

$app->controller('index')
	->any('/', 'index');

$app->controller('auth')
	->get( '/auth/', 'index' )
	->get( '/auth/index', 'index' )
	->get( '/auth/login/', 'login' )
	->post( '/auth/login/', 'process_login' )
	->get( '/auth/logout/', 'logout' )
	->get( '/auth/change-password/', 'change_password' )
	->post( '/auth/change-password/', 'process_change_password' )
	->get( '/auth/password-reset/', 'password_reset' )
	->post( '/auth/password-reset/', 'process_password_reset' );

$app->controller('users')
	->any('/users/no-access/', 'no_access')
	->get('/users', 'index')
	->get('/users/profile/{id:i}?', 'profile')
	->get('/users/create', 'create')
	->post('/users/create', 'do_create')
	->get('/users/update/{id:i}', 'update')
	->post('/users/update/{id:i}', 'do_update')
	->get('/users/delete/{id:i}', 'delete')
	->post('/users/delete/{id:i}', 'do_delete');

// $app->controller('admin/styleguide')
// 	->get( '/admin/styleguide/', 'index' );
//
// $app->controller('admin/dashboard')
// 	->get( '/admin/dashboard/', 'index' );
//
// $app->controller('admin/content')
// 	->get( '/admin/content/pages', 'pages' )
// 	->get( '/admin/content/posts', 'posts' )
// 	->get( '/admin/content/events', 'events' );


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// Update Publish date for content
// Route::post('admin/content/update_publish_date', 'Admin\BaseController@updatePublishDate');
// Route::post('admin/content/publish', 'Admin\BaseController@publish');
// Route::post('admin/content/unpublish', 'Admin\BaseController@unpublish');

// // Media Routes
// Route::post('admin/media/ckeditorUpload', 'Admin\MediaController@ckeditorUpload', ['except' => 'show']);
// Route::get('admin/media/ckeditorBrowse', 'Admin\MediaController@ckeditorBrowse', ['except' => 'show']);
//
// //Setting > Users
// Route::resource('admin/users', 'Admin\UsersController', ['except' => 'show']);
// Route::get('admin/users/{id}/profile', ['as' => 'admin.user.profile', 'uses' => 'Admin\ProfileController@index']);
// Route::put('admin/users/{id}/profile', ['as' => 'admin.update.user.profile', 'uses' => 'Admin\ProfileController@update']);
//
// // Redirects /admin/ to the dashboard
// Route::get('admin', function () {
// 	return Redirect::route('admin.dashboard.index');
// });

/*
|--------------------------------------------------------------------------
| CMS Public Routes
|--------------------------------------------------------------------------
|
| This is where all the routes are defined for the public side of the CMS.
|
*/
// // Post handlers
// Route::post('/connect', 'Pub\ConnectController@index');
// Route::post('/infokit', 'Pub\InfoKitController@index');
// Route::post('/sign_up', 'Pub\SignUpController@index');
//
// // Styleguide Route
// Route::get('/styleguide', 'StyleGuideController@index');
//
// Route::get('/search/{keyword?}', [
// 	'as' => 'search',
// 	'uses' => 'Pub\SearchController@index'
// ]);
// Route::get('/', [
// 	'as' => 'home.index',
// 	'uses' => 'Pub\HomeController@index'
// ]);
// Route::resource('/', 'Pub\HomeController', ['except' => 'show']);
//
// Route::get('/sitemap', 'Pub\SitemapController@index');
// Route::get('/sitemap.xml', 'Pub\SitemapController@xml');
//
// // Catch all URL's
// Route::get('{permalink?}', 'Pub\PageController@index')->where('permalink', '.+');
