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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'AdminController@index')->name('admin.index');

Route::get('/admin/shipping-unit/create','ShippingUnitController@create')->name('shippingUnit.create');
Route::get('admin/shipping-unit/', 'ShippingUnitController@index')->name('shippingUnit.index');
Route::get('admin/shipping-unit/edit/{id}', 'ShippingUnitController@edit')->name('shippingUnit.edit');
Route::get('admin/shipping-unit/getall', 'ShippingUnitController@getall')->name('shippingUnit.getall');

Route::post('admin/shipping-unit/store', 'ShippingUnitController@store')->name('shippingUnit.store');
Route::post('admin/shipping-unit/update/', 'ShippingUnitController@update')->name('shippingUnit.update');
Route::post('admin/shipping-unit/delete', 'ShippingUnitController@delete')->name('shippingUnit.delete');



//datatables
Route::get('datatables','DatatablesController@getIndex')->name('datatables.index');
Route::get('datatables/anyData','DatatablesController@anyData')->name('datatables.data');
Route::get('datatables/index','DatatablesController@index')->name('datatables.index2');

// Route::get('datatables/getall','DatatablesController@getAll')->name('datatables.getall');
Route::get('datatables/filter','DatatablesController@filter')->name('datatables.filter');
