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
    return view('api');
});

Route::get('/kps', function () {
    return view('kps');
});

Route::get('/osym', function () {
    return view('osym');
});

Route::get('/yoksis', function () {
    return view('yoksis');
});

Route::get('/detsis', function () {
    return view('detsis');
});
