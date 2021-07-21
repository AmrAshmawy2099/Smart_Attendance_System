<?php

use App\Http\Controllers\Admin\UsersController;
use Faker\Guesser\Name;
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

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:Manage-users')->group(function(){
    Route::resource('/users','UsersController',['except' => ['create','show','store']]);


});
Route::get('records/{user}', 'Admin\UsersController@records' )->name('admin.users.records')->prefix('admin');
Route::get('records/{room}', 'RoomsController@records' )->name('rooms.records')->prefix('room')->middleware('can:Manage-users');
Route::get('records/{machine}', 'MachinesController@records' )->name('machines.records')->prefix('machine')->middleware('can:Manage-users');
Route::resource('rooms','RoomsController')->middleware('can:Manage-users');
Route::resource('machines','MachinesController')->middleware('can:Manage-users');
Route::resource('cards','CardsController')->middleware('can:Manage-users');
// Route::get('DeleteRecords','Admin\UsersController@deleteAllRecords')->name('records.delete')->prefix('records');
