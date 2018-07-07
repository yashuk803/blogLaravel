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
    return 'sfasdf';
});


Route::get('/categories/', 'HomeController@categoryIndex')->name('categories.index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/contacts', 'HomeController@contacts')->name('contacts');
Route::post('/sendEmail', 'HomeController@sendEmail')->name('send_email');


Auth::routes();

Route::middleware(['role'])->group(function () {
    Route::get('/categories/delete/{id}', 'HomeController@categoryDelete')->name('categories.delete');
    Route::get('/categories/create/{slug?}', 'HomeController@create')->name('categories.create');
    Route::post('/categories/save', 'HomeController@save')->name('categories.save');
    Route::get('/categories/{slug}', 'HomeController@category')->name('categories.show');

});