<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\ReportsController;
use App\Http\Controllers\Admin\TasksController;
use App\Http\Controllers\admin\UsersAdminController;
use App\Http\Controllers\user\ReportsUserController;
use App\Http\Controllers\user\TasksUserController;
use App\Http\Controllers\user\UserController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->role->name === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('home');
        }
    }
    return redirect()->route('login');
})->name('home');

Auth::routes(['middleware' => ['redirectIfAuthenticated']]);

Route::middleware(['auth', 'role.admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    // Tasks
    Route::resource('tasks', TasksController::class);

    // Reports
    Route::get('reports', [ReportsController::class, 'index'])->name('reports.index');
    Route::get('reports/{report}', [ReportsController::class, 'show'])->name('reports.show');

    // Users
    Route::resource('users', UsersAdminController::class);
});

Route::middleware(['auth', 'role.user'])->group(function () {
    Route::get('/home', [UserController::class, 'index'])->name('home');

    // List Tasks
    Route::get('tasks-user', [TasksUserController::class, 'index'])->name('tasks-user.index');
    Route::get('tasks-user/{task}', [TasksUserController::class, 'show'])->name('tasks-user.show');
    Route::post('tasks-user/{task}/accept', [TasksUserController::class, 'accept'])->name('tasks-user.accept');
    Route::post('tasks-user/{task}/reject', [TasksUserController::class, 'reject'])->name('tasks-user.reject');
    Route::post('tasks-user/{task}/complete', [TasksUserController::class, 'complete'])->name('tasks-user.complete');
    // Route::delete('tasks-user/{task}', [TasksUserController::class, 'destroy'])->name('tasks-user.destroy');

    // Reports
    Route::get('reports-user', [ReportsUserController::class, 'index'])->name('reports-user.index');
    Route::get('reports-user-all', [ReportsUserController::class, 'all'])->name('reports-user-all.all-reports');
    Route::get('reports-user/create/{taskId}', [ReportsUserController::class, 'create'])->name('reports-user.create');
    Route::post('reports-user', [ReportsUserController::class, 'store'])->name('reports-user.store');
    Route::get('reports-user/{report}', [ReportsUserController::class, 'show'])->name('reports-user.show');
    Route::get('reports-user/{report}/edit', [ReportsUserController::class, 'edit'])->name('reports-user.edit');
    Route::put('reports-user/{report}', [ReportsUserController::class, 'update'])->name('reports-user.update');
    Route::delete('reports-user/{report}', [ReportsUserController::class, 'destroy'])->name('reports-user.destroy');
    Route::post('reports-user/{task}/cancel', [ReportsUserController::class, 'cancel'])->name('reports-user.cancel');
});
