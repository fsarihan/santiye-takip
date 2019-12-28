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
	
	Route::name('panel')
		->middleware('user')
		->prefix('panel')
		->group(function () {
			
			Route::get('/', 'Dashboard@index')
				->name('.index');
			Route::get('logout', 'User@logout')
				->name('.logout');
			Route::get('isciler', 'Dashboard@isciler')
				->name('.isciler');
		});
	
	Route::name('user')
		->middleware('guest')
		->group(function () {
			Route::get('login', 'User@index')
				->name('.login');
			Route::post('login', 'User@loginPost')
				->name('.loginPost');
			Route::post('register', 'User@registerPost')
				->name('.registerPost');
		});