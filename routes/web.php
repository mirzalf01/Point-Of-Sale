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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

/* Supplier Route Page */
Route::get('/suppliers', 'SupplierController@suppliers');
Route::get('/suppliers/tambah', 'SupplierController@supTambah');
Route::post('/suppliers/tambahproses', 'SupplierController@supTambahProses');
Route::get('/suppliers/hapus/{id}', 'SupplierController@hapus');
Route::get('/suppliers/edit/{id}', 'SupplierController@edit');
Route::post('/suppliers/editproses', 'SupplierController@editproses');

/* Employee Route Page */
Route::get('/employees', 'EmployeeController@employees');
Route::get('/employees/tambah', 'EmployeeController@empTambah');
Route::post('/employees/tambahproses', 'EmployeeController@empTambahProses');
Route::get('/employees/hapus/{id}', 'EmployeeController@hapus');
Route::get('/employees/edit/{id}', 'EmployeeController@edit');
Route::post('/employees/editproses', 'EmployeeController@editProses');

/* User Route */
Route::get('/user/profile', 'EmployeeController@profile');
Route::post('/user/profile/edit', 'EmployeeController@userEdit');
Route::post('/user/password/change', 'EmployeeController@changePass');

/* Customer Route Page */
Route::get('/customers', 'CustomerController@customers');
Route::get('/customers/tambah' , 'CustomerController@cusTambah');
Route::post('/customers/tambahproses', 'CustomerController@cusTambahProses');
Route::get('/customers/hapus/{id}', 'CustomerController@hapus');
Route::get('/customers/edit/{id}', 'CustomerController@edit');
Route::post('/customers/editproses', 'CustomerController@editProses');

/* Product Controller */
// Categories
Route::get('/products/categories', 'ProductController@categories');
Route::get('/categories/tambah', 'ProductController@catTambah');
Route::post('/categories/cattambahproses', 'ProductController@catTambahProses');
Route::get('/categories/hapus/{id}', 'ProductController@catHapus');
Route::get('/categories/edit/{id}', 'ProductController@catEdit');
Route::post('/categories/cateditproses', 'ProductController@catEditProses');

// Units
Route::get('/products/units', 'ProductController@units');
Route::get('/units/tambah', 'ProductController@unitTambah');
Route::post('/units/unittambahproses', 'ProductController@unitTambahProses');
Route::get('/units/hapus/{id}', 'ProductController@unitHapus');
Route::get('/units/edit/{id}', 'ProductController@unitEdit');
Route::post('/units/uniteditproses', 'ProductController@unitEditProses');

// Items
Route::get('/products/items', 'ProductController@items');
Route::get('/items/tambah', 'ProductController@itemTambah');
Route::post('/items/itemtambahproses', 'ProductController@itemTambahProses');
Route::get('/items/hapus/{id}', 'ProductController@itemHapus');
Route::get('/items/edit/{id}', 'ProductController@itemEdit');
Route::post('/items/itemeditproses', 'ProductController@itemEditProses');

/* Transaction Route Pages */
// Purchases
Route::get('/transaction/purchases', 'TransactionController@purchases');
Route::get('/purchases/tambah', 'TransactionController@purTambah');
Route::post('/purchases/purtambahproses', 'TransactionController@purTambahProses');
Route::get('get/details/{id}', 'TransactionController@getDetails')->name('getDetails');
Route::get('/purchases/hapus/{id}', 'TransactionController@purHapus');

// Stock Out
Route::get('/transaction/stockout', 'TransactionController@stockout');  
Route::get('/stockout/tambah', 'TransactionController@stockoutTambah');
Route::post('/purchases/stockouttambahproses', 'TransactionController@stockoutTambahProses');
Route::get('/stockout/hapus/{id}', 'TransactionController@stockoutHapus');

//sales
Route::get('/transaction/sales', 'TransactionController@sales');
Route::post('/transaction/process', 'TransactionController@salesProcess');
Route::get('/invoice/print/{id}', 'TransactionController@invoicePrint');
Route::get('/invoice/process', 'TransactionController@invoiceProcess');

//cart
Route::post('/transaction/cart', 'TransactionController@cart');
Route::get('/cart/hapus/{id}', 'TransactionController@cartHapus');
Route::get('/cart/clearcart', 'TransactionController@cartClear');
Route::get('get/detailschart/{id}', 'TransactionController@getDetailsCart')->name('getDetailsCart');
Route::post('/cart/editproses', 'TransactionController@cartEdit');

/* Report Route */
Route::get('/report/sales', 'ReportController@sales');
Route::get('/report/filter', 'ReportController@reportfilter');
Route::get('/report/sales/{invoice}', 'ReportController@invDownload');

