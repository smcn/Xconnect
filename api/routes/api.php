<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'UserController@authenticate');
Route::get('open', 'DataController@open');

Route::group(['middleware' => 'jwt.verify', 'role' => 'admin'], function() {
	Route::post('user/add', 'UserController@register');
	Route::put('user/update', 'UserController@updateUser');
	Route::delete('user/delete', 'UserController@deleteUser');
	Route::get('user/me', 'UserController@getAuthenticatedUser');
	Route::get('user/all', 'UserController@getAllUser');
	
	Route::post('service/add', 'ServiceController@addService');
	Route::put('service/update', 'ServiceController@updateService');
	Route::delete('service/delete', 'ServiceController@deleteService');
	Route::get('service/all', 'ServiceController@getAllServices');
	
	Route::get('record/all', 'RecordController@getAllRecords');
	Route::get('record/user/{id}', 'RecordController@getUserRecords');
	Route::get('record/service/{id}', 'RecordController@getServiceRecords');
	Route::get('record/search/{id}', 'RecordController@getSearchRecords');
	
});

//KPS Roles
Route::group(['middleware' => 'jwt.verify', 'role' => 'kps'], function() {
	
	Route::get('KPS/BilesikKutukSorgulaKimlikNoServis/{id}', 'KPSController@BilesikKutukSorgulaKimlikNoServis');
	Route::get('KPS/KimlikNoSorgulaAdresServis/{id}', 'KPSController@KimlikNoSorgulaAdresServis');
	
});

//Yöksis Roles
Route::group(['middleware' => 'jwt.verify', 'role' => 'yoksis'], function() {
	
	//UniversiteBirimlerv4
	Route::get('Yoksis/UniversiteBirimlerv4/{method}', 'YoksisController@UniversiteBirimlerv4');
	Route::get('Yoksis/UniversiteBirimlerv4/{method}/{id}', 'YoksisController@UniversiteBirimlerv4');
	Route::get('Yoksis/UniversiteBirimlerv4/{method}/{gun}/{ay}/{yil}', 'YoksisController@UniversiteBirimlerv4');
	
	//Ozgecmisv1
	Route::get('Yoksis/Ozgecmisv1/{method}/{id}', 'YoksisController@Ozgecmisv1');
	Route::get('Yoksis/Ozgecmisv1/{method}/{date}/{id}', 'YoksisController@Ozgecmisv1');
	
	//UniversiteAkademikPersonelv1
	Route::get('Yoksis/UniversiteAkademikPersonelv1/{method}/{id}', 'YoksisController@UniversiteAkademikPersonelv1');
	Route::get('Yoksis/UniversiteAkademikPersonelv1/{method}/{id}/{page}', 'YoksisController@UniversiteAkademikPersonelv1');
	
	//TcKimlikNoileMezunOgrenciSorgulav2	
	Route::get('Yoksis/TcKimlikNoileMezunOgrenciSorgulav2/{method}/{id}', 'YoksisController@TcKimlikNoileMezunOgrenciSorgulav2');
	
	//TcKimlikNoileOgrenciSorgulaDetayv4  (Mezunlar hariç)	
	Route::get('Yoksis/TcKimlikNoileOgrenciSorgulaDetayv4/{method}/{id}', 'YoksisController@TcKimlikNoileOgrenciSorgulaDetayv4');
	
	//mebmezunsorgulav2 
	Route::get('Yoksis/MEBMezunSorgulav2/{method}/{id}', 'YoksisController@MEBMezunSorgulav2');
	
});

//ÖSYM Roles
Route::group(['middleware' => 'jwt.verify', 'role' => 'osym'], function() {
	
	Route::get('OSYM/BilgiServisi/{method}', 'OSYMController@BilgiServisi');
	Route::get('OSYM/BilgiServisi/{method}/{id}/{resultId}/', 'OSYMController@BilgiServisi');
	Route::get('OSYM/BilgiServisi/{method}/{id}/{year}/{groupId}', 'OSYMController@BilgiServisi');
});

//DETSİS Roles
Route::group(['middleware' => 'jwt.verify', 'role' => 'detsis'], function() {
	
	Route::get('DETSIS/DETSISServis/{method}', 'DETSISController@DETSISServis');
	Route::get('DETSIS/DETSISServis/{method}/{id}', 'DETSISController@DETSISServis');
	Route::get('DETSIS/DETSISServis/{method}/{search}/{id}', 'DETSISController@DETSISServis');
});










