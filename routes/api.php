<?php

use App\Http\Controllers\Api\User\AuthController as UserAuthController;
use App\Http\Controllers\Api\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Api\Teacher\AuthController as TeacherAuthController;
use App\Http\Controllers\Api\User\Account\AccountController as UserAccountController;
use App\Http\Controllers\Api\Admin\Account\AccountController as AdminAccountController;
use App\Http\Controllers\Api\Teacher\Account\AccountController as TeacherAccountController;
// use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;

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

Route::get('/sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);

// Route::post('/{guard}/login', [LoginController::class, 'login']);
// Route::get('/{guard}/logout', [LoginController::class, 'logout']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// User Routes 
Route::prefix('user')->name('user.')->namespace('User')->group(function () {

    // Open routes
    Route::post('/login', [UserAuthController::class, 'login']);
    Route::post('/register', [UserAuthController::class, 'register']);

    // Protected routes
    Route::middleware(['auth:user,sanctum'])->group(function () {
        // Route::middleware(['auth:user'])->group(function () {
        Route::post('/logout', [UserAuthController::class, 'logout']);
        Route::get('/user', [UserAuthController::class, 'account']);

        Route::prefix('account')->name('account.')->namespace('Account')->group(function () {
            Route::get('/', [UserAccountController::class, 'index'])->name('list');

            Route::prefix('create')->group(function () {
                Route::get('/', [UserAccountController::class, 'create'])->name('create');
                Route::post('/', [UserAccountController::class, 'store'])->name('store');
            });

            Route::prefix('{id}')->group(function () {
                Route::get('/', [UserAccountController::class, 'show'])->name('show');
                Route::prefix('edit')->group(function () {
                    Route::get('/', [UserAccountController::class, 'edit'])->name('edit');
                    Route::post('/', [UserAccountController::class, 'update'])->name('update');
                });
                Route::delete('/', [UserAccountController::class, 'destroy'])->name('delete');
            });
        });
    });
    // });
});

// Admin Routes 
Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function () {

    // Open routes
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/register', [AdminAuthController::class, 'register']);

    // Protected routes
    // Route::middleware(['auth:admin'])->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout']);

        Route::get('/admin', [AdminAuthController::class, 'account']);

        Route::prefix('account')->name('account.')->namespace('Account')->group(function () {
            Route::get('/', [AdminAccountController::class, 'index'])->name('list');

            Route::prefix('create')->group(function () {
                Route::get('/', [AdminAccountController::class, 'create'])->name('create');
                Route::post('/', [AdminAccountController::class, 'store'])->name('store');
            });

            Route::prefix('{id}')->group(function () {
                Route::get('/', [AdminAccountController::class, 'show'])->name('show');
                Route::prefix('edit')->group(function () {
                    Route::get('/', [AdminAccountController::class, 'edit'])->name('edit');
                    Route::post('/', [AdminAccountController::class, 'update'])->name('update');
                });
                Route::delete('/', [AdminAccountController::class, 'destroy'])->name('delete');
            });
        });
    });
    // });
});

// Teacher Routes
Route::prefix('teacher')->name('teacher.')->namespace('Teacher')->group(function () {

    // Open routes
    Route::post('/login', [TeacherAuthController::class, 'login']);
    Route::post('/register', [TeacherAuthController::class, 'register']);

    // Protected routes
    // Route::middleware(['auth:teacher'])->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [TeacherAuthController::class, 'logout']);
        Route::get('/teacher', [TeacherAuthController::class, 'account']);

        Route::prefix('account')->name('account.')->namespace('Account')->group(function () {
            Route::get('/', [TeacherAccountController::class, 'index'])->name('list');

            Route::prefix('create')->group(function () {
                Route::get('/', [TeacherAccountController::class, 'create'])->name('create');
                Route::post('/', [TeacherAccountController::class, 'store'])->name('store');
            });

            Route::prefix('{id}')->group(function () {
                Route::get('/', [TeacherAccountController::class, 'show'])->name('show');
                Route::prefix('edit')->group(function () {
                    Route::get('/', [TeacherAccountController::class, 'edit'])->name('edit');
                    Route::post('/', [TeacherAccountController::class, 'update'])->name('update');
                });
                Route::delete('/', [TeacherAccountController::class, 'destroy'])->name('delete');
            });
        });
    });
    // });
});
