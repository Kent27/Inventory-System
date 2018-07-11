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

Route::get('/', 'UsersController@index');
Route::get('/login', 'LoginController@create')->name('login');
Route::post('/login', 'LoginController@store');

Route::get('/logout', 'LoginController@destroy');
Route::get('/home', 'UsersController@index');

Route::get('/documents/create', 'DocumentsController@create');
Route::post('/documents', 'DocumentsController@store');
Route::get('/documents', 'DocumentsController@index');

Route::get('/siteinstructs/create', 'SiteinstructsController@create');
/*Route::post('/siteinstructs', 'SiteinstructsController@store');
Route::get('/siteinstructs', 'SiteinstructsController@index');
*/
Route::get('/datatables', 'SiteinstructsController@anyData')->name('datatables.data');
Route::get('/datatables-item', 'ItemsController@datatables')->name('datatables.items');
Route::get('/datatables-trans', 'TransactionsController@datatables')->name('datatables.trans');

Route::group(['middleware' => ['web']], function() {
  Route::resource('siteinstructs','SiteinstructsController');
  /*Route::POST('addPost','SiteinstructsController@addSI');*/
  Route::POST('editPost','SiteinstructsController@editPost');
  Route::POST('deletePost','SiteinstructsController@deletePost');
});

Route::POST('editItem','ItemsController@edit');
Route::POST('deleteItem','ItemsController@destroy');

Route::resource('items', 'ItemsController');

Route::POST('editTransaction', 'TransactionsController@edit');
Route::resource('transactions', 'TransactionsController');
