<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
        Set\System as SetSystem,
        Set\User as SetUser,
        User\Merchant,
        User\Store,
        User\UserController,
        Permission\Permission,
        Permission\Role,
        HomeController,
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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

//首页
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/home/console', [HomeController::class, 'console'])->name('home.console');

//用户
Route::group(['prefix'=>'user'], function(){
    Route::get('user/list',[UserController::class, 'list'])->name('admin.user.user.list');
    Route::get('user/userform',[UserController::class, 'userform'])->name('admin.user.user.userform');
    Route::get('merchant/list', [Merchant::class, 'list'])->name('admin.user.merchant.list');
    Route::get('store/list', [Store::class, 'list'])->name('admin.user.store.list');
});

//权限
Route::group(['prefix'=>'permission'], function(){
    Route::get('permission/adminform', [Permission::class, 'adminform'])->name('admin.permission.permission.adminform');
    Route::get('permission/list', [Permission::class, 'list'])->name('admin.permission.permission.list');
    Route::get('role/role', [Role::class, 'role'])->name('admin.permission.role.role');
    Route::any('role/roleform', [Role::class, 'roleform'])->name('admin.permission.role.roleform');
});

//设置
Route::group(['prefix'=> 'set'], function(){
    Route::get('system/website', [SetSystem::class, 'website'])->name('admin.set.system.website');
    Route::get('system/email', [SetSystem::class, 'email'])->name('admin.set.system.email');
    Route::get('user/info', [SetUser::class, 'info'])->name('admin.set.user.info');
    Route::get('user/password', [SetUser::class, 'password'])->name('admin.set.user.password');
});



