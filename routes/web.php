<?php

use App\Models\User_role;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\Staff\Auth\UserController;
use App\Http\Controllers\Staff\Auth\RegisterController;
use App\Http\Controllers\Agent\Page\AgentPageController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\Staff\flyclass\ClassesController;
use App\Http\Controllers\Staff\flyclass\DestinationController;

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


Route::middleware('staff')->group(function () {
// Dashboard Routes
Route::get('/admin', [StaffController::class, 'index'])->name('admin.index');

// Dashboard Users/Agents

Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user.index');
Route::get('/admin/user/store', [UserController::class, 'store'])->name('admin.user.store');
Route::post('/admin/user/create', [UserController::class, 'create'])->name('admin.user.create');



// Dashboard Destinations

Route::get('/admin/destination', [DestinationController::class, 'index'])->name('admin.destination.index');
Route::post('/admin/destination/create', [DestinationController::class, 'create'])->name('admin.destination.create');

// Dashboard Destinations End Here

// Dashboard Prices

Route::get('/admin/prices', [ClassesController::class, 'index'])->name('admin.price.index');
Route::post('/admin/prices/create/{id}', [ClassesController::class, 'create'])->name('admin.price.create');
Route::post('/admin/prices/edit', [ClassesController::class, 'create'])->name('admin.price.edit');
Route::post('/admin/prices/delete/admin/{id}', [ClassesController::class, 'delete'])->name('admin.price.delete');
Route::post('/admin/prices/update/admin/{id}', [ClassesController::class, 'staffUpdate'])->name('admin.price.staffUpdate');
Route::post('/admin/prices/update/staff/{id}', [ClassesController::class, 'adminUpdate'])->name('admin.price.adminUpdate');


// Dashboard Prices End Here

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
Route::get('/dashboard/price', [AgentPageController::class, 'price'])->name('agent.price')->middleware('agent');


Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');