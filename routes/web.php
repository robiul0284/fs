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
    return view('auth.login');
});

Auth::routes();

Route::group(['prefix'=>'admin', 'middleware'=>'auth','namespace'=>'admin'], function (){
   Route::get('dashboard','DashboardController@index')->name('admin.dashboard');
   Route::resource('category', 'CategoryController');
   Route::resource('product', 'ProductController');
   Route::resource('godown', 'GodownController');
   Route::resource('inventory', 'InventoryController');
   Route::resource('customer', 'CustomerController');
   Route::resource('account', 'AccountController');
   Route::resource('supplier', 'SupplierController');
   Route::resource('purchase', 'PurchaseController');
   Route::get('list', 'ProductListController@productList')->name('product.list');
   Route::get('quantity/{id}', 'ProductListController@ajaxQuantity')->name('product.quantity');
   Route::resource('cash', 'CashController');
   Route::resource('sale', 'SaleController');
   Route::resource('payable', 'AccountPayableController');
   Route::resource('receivable', 'AccountReceivableController');
   Route::get('return', 'PurchaseReturnController@index')->name('purchase.return');
   Route::post('purchase/return', 'PurchaseReturnController@return')->name('return.search');
   Route::post('purchase/return/save', 'PurchaseReturnController@save')->name('return.save');
   Route::get('pretty/cash', 'PrettyCashController@index')->name('pretty.cash.index');
   Route::get('pretty/cash/create', 'PrettyCashController@create')->name('pretty.cash.create');
   Route::post('pay/receipt', 'PrettyCashController@transaction')->name('payment.receipt');
   Route::get('pretty/cash/tran/{id}', 'PrettycashController@edit')->name('pretty.cash.tran');
   Route::post('pretty/cash/update{personId}', 'PrettycashController@update')->name('pretty.cash.update');
   Route::resource('bank/details', 'BDController');
   Route::resource('bank', 'BankController');
   Route::resource('expanse', 'ExpanseController');
   Route::get('daily-profit', 'ReportController@dailyProfit')->name('daily.profit');
});


