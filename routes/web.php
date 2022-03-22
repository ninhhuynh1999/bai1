<?php
use Illuminate\Support\Facades\Auth;
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



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'AdminController@index')->name('admin.index');

Route::get('/admin/shipping-unit/create','ShippingUnitController@create')->name('shippingUnit.create');
Route::post('admin/shipping-unit/store', 'ShippingUnitController@store')->name('shippingUnit.store');
Route::get('admin/shipping-unit/', 'ShippingUnitController@index')->name('shippingUnit.index');
Route::get('admin/shipping-unit/edit/{id}', 'ShippingUnitController@edit')->name('shippingUnit.edit');
Route::post('admin/shipping-unit/update/', 'ShippingUnitController@update')->name('shippingUnit.update');
Route::post('admin/shipping-unit/delete', 'ShippingUnitController@delete')->name('shippingUnit.delete');



//datatables
Route::get('datatables','DatatablesController@getIndex')->name('datatables.index');
Route::get('datatables/anyData','DatatablesController@anyData')->name('datatables.data');
Route::get('datatables/getAllShippingUnit','DatatablesController@getAllShippingUnit')->name('datatables.getAllShippingUnit');
