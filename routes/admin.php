<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
        Set\System as SetSystem,
        User\Merchant,
        User\Store,
        User\UserController,
        Permission\Permission,
        Permission\Role,
        Permission\Admin,
        HomeController,
};
use \App\Http\Controllers\Auth\LoginController;
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

//Auth::routes();
Route::get('admin/login', [LoginController::class, 'showLoginForm'])->name('admin.showLoginForm');
Route::post('admin/login', [LoginController::class, 'login'])->name('admin.login');

Route::group(['prefix'=>'admin', 'middleware'=>['guest:admin','menus']], function(){

    Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
    //首页
    Route::get('/home', [HomeController::class, 'index'])->name('admin.home');
    Route::get('/home/console', [HomeController::class, 'console'])->name('home.console');

//用户
    Route::group(['prefix'=>'user'], function(){
        Route::any('user/list',[UserController::class, 'list'])->name('admin.user.user.list');
        Route::any('user/userform',[UserController::class, 'userform'])->name('admin.user.user.userform');
        Route::any('merchant/list', [Merchant::class, 'list'])->name('admin.user.merchant.list');
        Route::any('merchant/merchantform', [Merchant::class, 'merchantform'])->name('admin.user.merchant.merchantform');
        Route::any('store/list', [Store::class, 'list'])->name('admin.user.store.list');
        Route::any('store/storeform', [Store::class, 'storeform'])->name('admin.user.store.storeform');
    });

//权限
    Route::group(['prefix'=>'permission'], function(){
        Route::any('permission/list', [Permission::class, 'list'])->name('admin.permission.permission.list');
        Route::any('permission/adminform', [Permission::class, 'adminform'])->name('admin.permission.permission.adminform');
        Route::post('permission/delete', [Permission::class, 'delete'])->name('admin.permission.permission.delete');
        Route::any('role/list', [Role::class, 'list'])->name('admin.permission.role.list');
        Route::any('role/roleform', [Role::class, 'roleform'])->name('admin.permission.role.roleform');
        Route::any('member/list', [Admin::class, 'list'])->name('admin.permission.member.list');
        Route::any('member/adminform', [Admin::class, 'adminform'])->name('admin.permission.member.adminform');
    });

//设置
    Route::group(['prefix'=> 'set'], function(){
        Route::get('system/website', [SetSystem::class, 'website'])->name('admin.set.system.website');
    });
});



