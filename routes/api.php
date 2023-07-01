<?php

use App\Http\Controllers\Admin\GroupsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Api\RegisterController;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('passport-token',function(){
    $user = User::find(6);
    $tokenResult = $user->createToken('auth_api');
    // Thiet lap expried
    $token = $tokenResult->token;
    $token->expires_at = Carbon::now()->addMinutes(60);
    
    // Tra ve access token
    $accessToken = $tokenResult->accessToken;

    //Tra ve expires
    $expires = Carbon::parse($token->expire_at)->toDateTimeString();
    $response = [
        'access_token' => $accessToken,
        'expies' => $expires
    ];
     return $response;
});
Auth::routes([]);
// api dang ky dang nhap
Route::post('register',[RegisterController::class,'register']);
Route::post('login',[RegisterController::class,'login']);

Route::post('logout',[RegisterController::class,'logout']);
// api phan quyen
Route::prefix('admin')->name('admin.')->middleware('jwt.auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
   
    // posts
    Route::prefix('post')->name('posts.')->group(function () {
        Route::get('/', [PostsController::class, 'index'])->name('index');
        Route::get('/add', [PostsController::class, 'add'])->name('add');
        Route::get('/edit/{id}', [PostsController::class, 'edit'])->name('edit');
        Route::get('/delete/{id}', [PostsController::class, 'delete'])->name('delete');
    });

    // groups
    Route::prefix('groups')->name('groups.')->middleware('checkPermission')->group(function () {
        Route::get('/', [GroupsController::class, 'index'])->name('view');
        Route::get('/add', [GroupsController::class, 'viewadd'])->name('add');
        Route::post('/add', [GroupsController::class, 'Groupadd'])->name('addGroup');

        Route::get('/edit/{id}', [GroupsController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [GroupsController::class, 'editGroup']);

        Route::get('/delete/{id}', [GroupsController::class, 'delete'])->name('delete');

        Route::get('/permission/{id}', [GroupsController::class, 'permission'])->middleware('checkActionPermissionGroup')->name('permission');
        Route::post('/permissionPost', [GroupsController::class, 'postPermission'])->name('Postpermission');
    });

    // users
    Route::prefix('users')->name('users.')->middleware('checkPermission')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->middleware('checkPermissionCRUD')->name('view');
        Route::get('/add', [UsersController::class, 'viewadd'])->middleware('checkPermissionCRUD')->name('add');
        Route::post('/add', [UsersController::class, 'Useradd'])->middleware('checkPermissionCRUD')->name('addUser');

        Route::get('/edit/{id}', [UsersController::class, 'edit'])->middleware('checkPermissionCRUD')->name('edit');
        Route::post('/edit/{id}', [UsersController::class, 'Useredit'])->middleware('checkPermissionCRUD')->name('editUser');

        Route::get('/delete/{id}', [UsersController::class, 'delete'])->middleware('checkPermissionCRUD')->name('delete');
    });
});