<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\AdministratorsController;
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
    return view('home');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/console', [HomeController::class, 'console'])->name('home.console');
Route::get('/homepage1', [HomeController::class, 'homepage1'])->name('home.homepage1');
Route::get('/homepage2', [HomeController::class, 'homepage2'])->name('home.homepage2');

Route::group(['prex'=>'user'], function(){
    Route::get('user/list',[UserController::class, 'list'])->name('user.user.list');
});

Route::get('/user/administrators/adminform', [AdministratorsController::class, 'adminform'])->name('user.administrators.adminform');
Route::get('/user/administrators/list', [AdministratorsController::class, 'list'])->name('user.administrators.list');
Route::get('/user/administrators/role', [AdministratorsController::class, 'role'])->name('user.administrators.role');
Route::get('/user/administrators/roleform', [AdministratorsController::class, 'roleform'])->name('role.administrators.roleform');


