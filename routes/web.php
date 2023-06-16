<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GroupsController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\UsersController;
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

Auth::routes([]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    // posts
    Route::prefix('post')->name('posts.')->group(function () {
        Route::get('/', [PostsController::class, 'index'])->name('index');
        Route::get('/add', [PostsController::class, 'add'])->name('add');
        Route::get('/edit/{id}', [PostsController::class, 'edit'])->name('edit');
        Route::get('/delete/{id}', [PostsController::class, 'delete'])->name('delete');
    });

    // groups
    Route::prefix('groups')->name('groups.')->group(function () {
        Route::get('/', [GroupsController::class, 'index'])->name('index');
        Route::get('/add', [GroupsController::class, 'viewadd'])->name('add');
        Route::post('/add', [GroupsController::class, 'Groupadd'])->name('GroupAdd');
        
        Route::get('/edit/{id}', [GroupsController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [GroupsController::class, 'Groupedit']);

        Route::get('/delete/{id}', [GroupsController::class, 'delete'])->name('delete');

        Route::get('/permission/{id}', [GroupsController::class, 'permission'])->name('permission');
        Route::post('/permissionPost', [GroupsController::class, 'postPermission'])->name('Postpermission');
    });
   
    // users
    Route::prefix('users')->name('users.')->middleware('checkPermission:users')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('index');
        Route::get('/add', [UsersController::class, 'viewadd'])->name('add');
        Route::post('/add', [UsersController::class, 'Useradd'])->name('postAdd');
        
        Route::get('/edit/{id}', [UsersController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [UsersController::class, 'Useredit']);

        Route::get('/delete/{id}', [UsersController::class, 'delete'])->name('delete');
    });
});
