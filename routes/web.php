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

	Route::get('usuarios/ajaxUsers', 'UsersController@ajaxUsers')->name('admin.users.ajaxUsers');

	Route::put('usuarios/{user}', 'UsersController@update')->name('admin.users.update');

	Route::delete('usuarios/{user}', 'UsersController@destroy')->name('admin.users.destroy');

	Route::resource('usuarios', 'UsersController', ['names' => [
	    'index' => 'admin.users.index',
	    'create' => 'admin.users.create',
	    'store' => 'admin.users.store',
	    'edit' => 'admin.users.edit'
	]]);

	Route::get('roles', 'RolesController@index')->name('admin.roles.index');
	Route::post('roles', 'RolesController@store')->name('admin.roles.store');
	Route::get('roles/{rol}/edit', 'RolesController@edit')->name('admin.roles.edit');
	Route::put('roles/{rol}', 'RolesController@update')->name('admin.roles.update');
	Route::delete('roles/{rol}', 'RolesController@destroy')->name('admin.roles.destroy');



});



