<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MemberController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::get('/admin/register', [AdminController::class, 'showCompleteRegistrationForm'])
    ->name('admin.register');
Route::post('/admin/register', [AdminController::class, 'completeRegistration'])
    ->name('admin.register.complete');

Route::middleware('auth')->group(function () {

    Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin.index');
    Route::get('/admin/user', [AdminController::class, 'create'])
        ->name('admin.create');
    Route::post('/admin/user', [AdminController::class, 'store'])
        ->name('admin.store');
    Route::delete('/admin/user/{user}', [AdminController::class, 'destroy'])
        ->name('admin.destroy');

    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('member', MemberController::class);
});
