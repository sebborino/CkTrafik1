<?php

use App\Models\User_role;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\staff\Auth\UserController;
use App\Http\Controllers\Staff\Auth\RegisterController;
use App\Http\Controllers\Agent\Page\AgentPageController;

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


Route::get('/', [LoginController::class, 'index'])->name('index');
Route::post('/login', [LoginController::class, 'login'])->name('login');



// Dashboard Routes

Route::middleware('staff')->group(function () {
Route::get('/admin', [StaffController::class, 'index'])->name('admin.index')->middleware('staff');

// Dashboard Users/Agents

Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user.index');
Route::get('/admin/user/store', [UserController::class, 'store'])->name('admin.user.store');
Route::post('/admin/user/create', [UserController::class, 'create'])->name('admin.user.create');
//Route::get('/dashboard/user', [UserController::class, 'Store'])->name('user.index');
//Route::get('/dashboard/user', [UserController::class, 'Store'])->name('user.index');
//Route::get('/dashboard/user', [UserController::class, 'Store'])->name('user.index');

Route::get('/dashboard/register/index', [RegisterController::class, 'staffStore'])->name('register.staff');

Route::get('/dashboard/register/agent', [RegisterController::class, 'AgentStore'])->name('register.agent');

// Dashboard Register/Users/Agents End

Route::get('/dashboard/tables', function () {
    return view('admin.page.tables');
    });
});

// Dashboard Routes End here

// Dashboard For Agent Start Here
Route::get('/dashboard', [AgentPageController::class, 'index'])->name('agent.index')->middleware('agent');