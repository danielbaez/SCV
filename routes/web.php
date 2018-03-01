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
    return redirect('login');
});

// Authentication Routes...
/*$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');*/

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');

Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//Route::group(['middleware' => ['auth']], function () {
Route::group(['prefix' => 'admin', /*'namespace' => 'Admin',*/ 'middleware' => 'auth'], function() {

	//Auth::routes();
	
	Route::get('dashboard', 'HomeController@index')->name('admin.dashboard');

	Route::get('users/ajaxUsers', 'UsersController@ajaxUsers')->name('admin.users.ajaxUsers');
	Route::resource('users', 'UsersController', 
		['parameters' => ['users' => 'user'],
		 'as' => 'admin'
		]
	);

	Route::resource('roles', 'RolesController', 
		['parameters' => ['roles' => 'rol'],
		 'as' => 'admin'
		]
	);

	Route::resource('vouchers', 'VouchersController', ['as' => 'admin']);

	Route::resource('configurations', 'ConfigurationsController',
		['as' => 'admin',
		 'except' => [
    		'create', 'store', 'destroy'
		 ]
		]
	);

	Route::get('categories/ajaxCategories', 'CategoriesController@ajaxCategories')->name('admin.categories.ajaxCategories');
	Route::resource('categories', 'CategoriesController', ['as' => 'admin']);

	Route::get('brands/ajaxBrands', 'BrandsController@ajaxBrands')->name('admin.brands.ajaxBrands');
	Route::resource('brands', 'BrandsController', ['as' => 'admin']);

	Route::get('presentations/ajaxPresentations', 'PresentationsController@ajaxPresentations')->name('admin.presentations.ajaxPresentations');
	Route::resource('presentations', 'PresentationsController', ['as' => 'admin']);

	Route::get('products/ajaxProducts', 'ProductsController@ajaxProducts')->name('admin.products.ajaxProducts');
	Route::resource('products', 'ProductsController', ['as' => 'admin']);

	Route::get('providers/ajaxProviders', 'ProvidersController@ajaxProviders')->name('admin.providers.ajaxProviders');
	Route::resource('providers', 'ProvidersController', ['as' => 'admin']);

});



