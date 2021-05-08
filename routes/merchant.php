<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Merchant\{
        Set\System as SetSystem,
        User\Merchant,
        User\Store,
        User\UserController,
        Permission\Permission,
        Permission\Role,
        Permission\Admin,
        HomeController,
        LoginController
};
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
//首页
Route::group(['prefix'=>'merchant'], function(){
    Route::any('/login', [LoginController::class, 'login'])->name('merchant.login');

    Route::get('/home', [HomeController::class, 'index'])->name('merchant.home');
    Route::get('/home/console', [HomeController::class, 'console'])->name('merchant.home.console');

//用户
    Route::group(['prefix'=>'user'], function(){
        Route::any('user/list',[UserController::class, 'list'])->name('merchant.user.user.list');
        Route::any('user/userform',[UserController::class, 'userform'])->name('merchant.user.user.userform');
        Route::any('merchant/list', [Merchant::class, 'list'])->name('merchant.user.merchant.list');
        Route::any('store/list', [Store::class, 'list'])->name('merchant.user.store.list');
        Route::any('store/storeform', [Store::class, 'storeform'])->name('merchant.user.store.storeform');
    });

//权限
    Route::group(['prefix'=>'permission'], function(){
        Route::any('permission/list', [Permission::class, 'list'])->name('merchant.permission.permission.list');
        Route::get('permission/adminform', [Permission::class, 'adminform'])->name('merchant.permission.permission.adminform');
        Route::any('role/list', [Role::class, 'list'])->name('merchant.permission.role.list');
        Route::any('role/roleform', [Role::class, 'roleform'])->name('merchant.permission.role.roleform');
        Route::any('member/list', [Admin::class, 'list'])->name('merchant.permission.member.list');
        Route::any('member/adminform', [Admin::class, 'adminform'])->name('merchant.permission.member.adminform');
    });

//设置
    Route::group(['prefix'=> 'set'], function(){
        Route::get('system/website', [SetSystem::class, 'website'])->name('merchant.set.system.website');
    });
});



