<?php

use App\Models\User_role;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\Staff\Auth\UserController;
use App\Http\Controllers\Staff\Auth\RegisterController;
use App\Http\Controllers\Agent\Page\AgentPageController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ShowNotificationWallet;
use App\Http\Controllers\Staff\Agent\AgentController;
use App\Http\Controllers\Staff\Agent\Wallet\WalletController;
use App\Http\Controllers\Staff\Airline\AircraftController;
use App\Http\Controllers\Staff\Airline\AirlineController;
use App\Http\Controllers\Staff\Flight\FlightController;
use App\Http\Controllers\Staff\Airport\AirportController;
use App\Http\Controllers\Staff\flyclass\ClassesController;
use App\Http\Controllers\Staff\Destination\DestinationController;
use App\Http\Controllers\Staff\Travels\TravelController;
use App\Models\Airport;

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

// Dashboard Airports


Route::get('/admin/airport/store', [AirportController::class, 'store'])->name('admin.airport.store');
Route::get('/admin/airport/{IATA}', [AirportController::class, 'index'])->name('admin.airport.index');
Route::post('/admin/airport/create', [AirportController::class, 'create'])->name('admin.airport.create');
Route::post('/admin/airport/update/{id}', [AirportController::class, 'update'])->name('admin.airport.update');

// Dashboard Airlines

Route::get('/admin/airline', [AirlineController::class, 'index'])->name('admin.airline.index');
Route::post('/admin/airline/create', [AirlineController::class, 'create'])->name('admin.airline.create');
Route::post('/admin/airline/update/{id}', [AirlineController::class, 'update'])->name('admin.airline.update');

// Dashboard Aircraft

Route::get('/admin/airline/aircraft', [AircraftController::class, 'index'])->name('admin.aircraft.index');
Route::post('/admin/arline/aircraft/create', [AircraftController::class, 'create'])->name('admin.aircraft.create');
Route::post('/admin/arline/aircraft/update/{id}', [AircraftController::class, 'update'])->name('admin.aircraft.update');


// Dashboard Flights

Route::get('/admin/flight', [FlightController::class, 'index'])->name('admin.flight.index');
Route::post('/admin/flight/create', [FlightController::class, 'create'])->name('admin.flight.create');
Route::post('/admin/flight/update/{id}', [FlightController::class, 'update'])->name('admin.flight.update');

// Dashboard Destinations

// Dashboard Agent Tables

Route::get('/admin/agent', [AgentController::class, 'index'])->name('admin.agent.index');
Route::get('/admin/agent/details/{id}', [AgentController::class, 'details'])->name('admin.agent.details');

// Wallet Controller
Route::post('/admin/agent/wallet/request/{id}', [WalletController::class, 'SendWalletRequest'])->name('admin.wallet.request');
Route::post('/admin/agent/wallet/close/{id}', [WalletController::class, 'CloseWallet'])->name('admin.wallet.close');
Route::post('/admin/agent/wallet/open/{id}', [WalletController::class, 'OpenWallet'])->name('admin.wallet.open');

// Wallet Controller End Here

// Dashboard Agent Tables End Here

Route::get('/admin/destination', [DestinationController::class, 'index'])->name('admin.destination.index');
Route::post('/admin/destination/create', [DestinationController::class, 'create'])->name('admin.destination.create');
Route::post('/admin/destination/update/{id}', [DestinationController::class, 'update'])->name('admin.destination.update');

// Dashboard Destinations End Here
// Dashboard Travels Start Here

Route::get('/admin/travel', [TravelController::class, 'index'])->name('admin.travel.index');
Route::get('/admin/travel/period', [TravelController::class, 'period'])->name('admin.travel.period');
Route::post('/admin/travel/period/create', [TravelController::class, 'create_period'])->name('admin.travel.period.create');
Route::any('/admin/travel/calender/{id}', [TravelController::class, 'calender'])->name('admin.travel.calender');
Route::get('/admin/travel/store/{id}/{date}', [TravelController::class, 'store'])->name('admin.travel.store');
Route::post('/admin/travel/create/{id}/{date}', [TravelController::class, 'create'])->name('admin.travel.create');
Route::get('/admin/travel/edit/{id}/{date}', [TravelController::class, 'edit'])->name('admin.travel.edit');
Route::post('/admin/travel/updfate/{id}', [TravelController::class, 'update'])->name('admin.travel.update');

// Dashboard Travels End Here
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

// Agent Notifications Start Here
Route::get('/dasboard/notification', [NotificationController::class, 'index'])->name('agent.notification.store')->middleware('agent');
Route::get('/dasboard/notification/wallet/{id}', [ShowNotificationWallet::class, 'wallet'])->name('agent.notification.wallet.request')->middleware('agent');
Route::get('/dasboard/notification/close/wallet/{id}', [ShowNotificationWallet::class, 'close'])->name('agent.notification.wallet.close')->middleware('agent');
Route::get('/dasboard/notification/open/wallet/{id}', [ShowNotificationWallet::class, 'close'])->name('agent.notification.wallet.open')->middleware('agent');


Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');