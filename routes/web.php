<?php
	
	use Illuminate\Support\Facades\Route;
	
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
			Route::get('/', 'PagesController@index')
				->name('.index');
			Route::get('/kullanici-tipleri', 'PagesController@kullaniciTipleri')
				->name('.kullaniciTipleri');
			Route::get('logout', 'User@logout')
				->name('.logout');
			Route::get('santiye-sec/{santiyeID}', 'PagesController@santiyeSec')
				->name('.santiyeSec');
			Route::get('santiyeler', 'PagesController@santiyeler')
				->name('.santiyeler');
			Route::get('santiye-muhasebe/calisan-maaslari/{donem}', 'PagesController@calisanMaaslariSantiyeDonem')
				->name('.calisanMaaslariSantiyeDonem');
			Route::get('santiye-muhasebe/calisan-maaslari/', 'PagesController@calisanMaaslariSantiye')
				->name('.calisanMaaslariSantiye');
			Route::get('santiye-muhasebe/calisan-maaslari/odeme-talebi/{hash}', 'PagesController@odemeTalebiOlustur')
				->name('.calisanMaaslariSantiyeOdemeTalebi');
			Route::get('santiye-muhasebe/santiye-giderleri/', 'PagesController@santiyeGiderleri')
				->name('.santiyeGiderleri');
			Route::get('santiye-muhasebe/santiye-giderleri/ekle', 'PagesController@santiyeGideriEkle')
				->name('.santiyeGideriEkle');
			Route::post('santiye-muhasebe/santiye-giderleri/ekle', 'PagesController@santiyeGideriEklePost')
				->name('.santiyeGideriEklePost');
			Route::get('puantaj', 'PagesController@puantaj')
				->name('.puantaj');
			Route::post('puantaj', 'PagesController@puantajPost')
				->name('.puantajPost');
			Route::get('puantaj-onay/{donem?}', 'PagesController@puantajOnay')
				->name('.puantajOnay');
			Route::get('calisanlar', 'PagesController@calisanlar')
				->name('.calisanlar');
			Route::get('calisanlar/ekle', 'PagesController@calisanEkle')
				->name('.calisanEkle');
			Route::post('calisanlar/ekle', 'PagesController@calisanEklePost')
				->name('.calisanEklePost');
		});
	
	Route::name('user')
		->middleware('guest')
		->group(function () {
			Route::get('login', 'User@index')
				->name('.login');
			Route::get('register', 'User@register')
				->name('.register');
			Route::post('login', 'User@loginPost')
				->name('.loginPost');
			Route::post('register', 'User@registerPost')
				->name('.registerPost');
		});
	
	Route::get('/', 'PagesController@index')
		->middleware('user');
	//
	//
	//// Demo routes
	Route::get('/datatables', 'PagesController@datatables');
	Route::get('/ktdatatables', 'PagesController@ktDatatables');
	Route::get('/select2', 'PagesController@select2');
	Route::get('/icons/custom-icons', 'PagesController@customIcons');
	//Route::get('/icons/flaticon', 'PagesController@flaticon');
	//Route::get('/icons/fontawesome', 'PagesController@fontawesome');
	//Route::get('/icons/lineawesome', 'PagesController@lineawesome');
	//Route::get('/icons/socicons', 'PagesController@socicons');
	//Route::get('/icons/svg', 'PagesController@svg');
	//
	//// Quick search dummy route to display html elements in search dropdown (header search)
	Route::get('/quick-search', 'PagesController@quickSearch')
		->name('quick-search');
