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

/** Users */
Route::get('/users','UserController@index')->name('users.index');
Route::get('/users/{user}/edit','UserController@edit')->name('users.edit');
Route::post('/users/store','UserController@store')->name('users.store');
Route::put('/users/{user}/update','UserController@update')->name('users.update');
Route::delete('/users/{user}/delete','UserController@delete')->name('users.delete');
Route::get('/users/send-email','UserController@sendEmail')->name('users.send-email');

/** Companies */
Route::get('/companies','CompanyController@index')->name('companies.index');
Route::get('/companies/{company}/edit','CompanyController@edit')->name('companies.edit');
Route::post('/companies/store','CompanyController@store')->name('companies.store');
Route::put('/companies/{company}/update','CompanyController@update')->name('companies.update');
Route::delete('/companies/{company}/delete','CompanyController@delete')->name('companies.delete');

/** Phones */
Route::get('/phones','PhoneNumberController@index')->name('phones.index');
Route::get('/phones/{phone}/edit','PhoneNumberController@edit')->name('phones.edit');
Route::post('/phones/store','PhoneNumberController@store')->name('phones.store');
Route::put('/phones/{phone}/update','PhoneNumberController@update')->name('phones.update');
Route::delete('/phones/{phone}/delete','PhoneNumberController@delete')->name('phones.delete');

/** Emails */
Route::get('/emails','EmailAddressController@index')->name('emails.index');
Route::get('/emails/{email}/edit','EmailAddressController@edit')->name('emails.edit');
Route::post('/emails/store','EmailAddressController@store')->name('emails.store');
Route::put('/emails/{email}/update','EmailAddressController@update')->name('emails.update');
Route::delete('/emails/{email}/delete','EmailAddressController@delete')->name('emails.delete');

/** Addresses */
Route::get('/addresses','AddressController@index')->name('addresses.index');
Route::get('/addresses/{address}/edit','AddressController@edit')->name('addresses.edit');
Route::post('/addresses/store','AddressController@store')->name('addresses.store');
Route::put('/addresses/{address}/update','AddressController@update')->name('addresses.update');
Route::delete('/addresses/{address}/delete','AddressController@delete')->name('addresses.delete');

/** Countries */
Route::get('/countries','CountryController@index')->name('countries.index');
Route::get('/countries/{country}/edit','CountryController@edit')->name('countries.edit');
Route::post('/countries/store','CountryController@store')->name('countries.store');
Route::put('/countries/{country}/update','CountryController@update')->name('countries.update');
Route::delete('/countries/{country}/delete','CountryController@delete')->name('countries.delete');
