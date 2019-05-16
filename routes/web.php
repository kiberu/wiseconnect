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

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


Route::get('/', 'HomeController@index')->name('home');
Route::group(['middleware' => [ 'web', 'auth'] ], function () {
  Route::Resource( '/users', 'UserController' )->except(['index']);
  Route::get('user/{type?}', 'UserController@index' )->name('user.index');
  Route::Resource( '/banks', 'BankController' );
  Route::Resource( '/expenditures', 'ExpenditureController' );
  Route::Resource( '/payables', 'PayableController' );
  Route::Resource( '/receivables', 'ReceivableController' );
  Route::Resource( '/groups', 'GroupController' );
  Route::post('/groups/transfer/{group}', 'GroupController@transfer' )->name('groups.transfer');
  Route::Resource('clients', 'ClientController');
  Route::Resource( '/loans', 'LoanController');
  Route::post( '/new-application', 'ClientController@store');
  Route::get( '/approve-loan', 'LoanController@approve');
  Route::prefix('/loans/{loan}')->group(function () {
    Route::Resource('installments', 'InstallmentController');
    Route::prefix('/installments/{installment}')->group(function () {
      Route::Resource('payments', 'PaymentController');
    });
  });
  Route::get('/loans-today', 'LoanController@today')->name('loans.today');
  Route::get('/loans-defaulters', 'LoanController@defaulters')->name('loans.defaulters');
  Route::get('/finance', 'FinanceController@index')->name('finance.index');
  Route::get('/cash-at-hand', 'FinanceController@cash')->name('finance.cash');
  Route::get('/payments-list', 'FinanceController@payments')->name('finance.payments');
  Route::get('/bad-loans', 'FinanceController@index')->name('finance.badloans');
  Route::get('/insurance-fees', 'FinanceController@insurance')->name('finance.insurance');
  Route::get('/application-fees', 'FinanceController@application')->name('finance.application');

});
