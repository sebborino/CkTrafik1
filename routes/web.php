<?php

use App\Models\Airport;
use App\Models\ClassType;
use App\Models\User_role;
use App\Models\FlightCategory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ShowNotificationWallet;
use App\Http\Controllers\FaktureGenerateController;
use App\Http\Controllers\Staff\Auth\UserController;
use App\Http\Controllers\ShowNotificationController;
use App\Http\Controllers\Api\ExchangeRatesController;
use App\Http\Controllers\Staff\Agent\AgentController;
use App\Http\Controllers\Staff\Auth\RegisterController;
use App\Http\Controllers\Staff\Flight\FlightController;
use App\Http\Controllers\Agent\Page\AgentPageController;
use App\Http\Controllers\AgentBookingController;
use App\Http\Controllers\Staff\Price\CurrencyController;
use App\Http\Controllers\Staff\Travels\TravelController;
use App\Http\Controllers\Staff\Airline\AirlineController;
use App\Http\Controllers\Staff\Airport\AirportController;
use App\Http\Controllers\Staff\Price\ClassTypeController;
use App\Http\Controllers\Staff\Airline\AircraftController;
use App\Http\Controllers\Staff\flyclass\ClassesController;
use App\Http\Controllers\Staff\Price\PriceController;
use App\Http\Controllers\Staff\Price\CurrencyRateController;
use App\Http\Controllers\Staff\Price\TravelerTypeController;
use App\Http\Controllers\Staff\Agent\Wallet\WalletController;
use App\Http\Controllers\Staff\Price\FlightCategoryController;
use App\Http\Controllers\Staff\Destination\DestinationController;
use App\Http\Controllers\Staff\Price\PriceCategoryController;

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
    return view('index');
})->name('index');

Route::get('/test/api', [ExchangeRatesController::class, 'test']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
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

// Dashboard Fakture



Route::get('/admin/economy',[FaktureGenerateController::class,'index'])->name('admin.economy.fakture');
Route::post('/admin/economy/create',[FaktureGenerateController::class,'store'])->name('admin.economy.fakture.create');

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

// Dashboard Flights

Route::get('/admin/flight/category', [PriceCategoryController::class, 'index'])->name('admin.flightCategory.index');
Route::post('/admin/flight/category/create', [PriceCategoryController::class, 'create'])->name('admin.flightCategory.create');
Route::post('/admin/flight/category/update/{id}', [PriceCategoryController::class, 'update'])->name('admin.flightCategory.update');

// Dashboard Destinations

// Dashboard Agent Tables

Route::get('/admin/agent', [AgentController::class, 'index'])->name('admin.agent.index');
Route::get('/admin/agent/details/{id}', [AgentController::class, 'details'])->name('admin.agent.details');

// Wallet Controller

Route::get('/admin/agent/wallet/{id}', [WalletController::class, 'store'])->name('admin.wallet.store');
Route::post('/admin/agent/wallet/settings/{id}', [WalletController::class, 'update'])->name('admin.wallet.update');
Route::post('/admin/agent/wallet/request/{id}', [WalletController::class, 'SendWalletRequest'])->name('admin.wallet.request');
Route::post('/admin/agent/wallet/close/{id}', [WalletController::class, 'walletClose'])->name('admin.wallet.close');
Route::post('/admin/agent/wallet/open/{id}', [WalletController::class, 'walletOpen'])->name('admin.wallet.open');

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

Route::get('/admin/sesson', [FlightCategoryController::class, 'index'])->name('admin.price.sesson');
Route::post('/admin/sesson/create', [FlightCategoryController::class, 'create'])->name('admin.price.sesson.create');
Route::post('/admin/sesson/update/{id}', [FlightCategoryController::class, 'update'])->name('admin.sesson.update');

// currencies

Route::get('/admin/currencies', [CurrencyController::class, 'index'])->name('admin.price.currency');
Route::post('/admin/currencies/create', [CurrencyController::class, 'create'])->name('admin.price.currency.create');
Route::post('/admin/currencies/update/{id}', [CurrencyController::class, 'update'])->name('admin.price.currency.update');

// Rates

Route::get('/admin/rate', [CurrencyRateController::class, 'index'])->name('admin.price.rate');
Route::post('/admin/rate/create', [CurrencyRateController::class, 'create'])->name('admin.price.rate.create');
Route::post('/admin/rate/update/{id}', [CurrencyRateController::class, 'update'])->name('admin.price.rate.delete');

// class Type

Route::get('/admin/classtype', [ClassTypeController::class, 'index'])->name('admin.class.index');
Route::post('/admin/classtype/create', [ClassTypeController::class, 'create'])->name('admin.classtype.create');
Route::post('/admin/classtype/update/{id}', [ClassTypeController::class, 'update'])->name('admin.classtype.update');

Route::get('/admin/travelerType', [TravelerTypeController::class, 'index'])->name('admin.travelerType.index');
Route::post('/admin/travelerType/create', [TravelerTypeController::class, 'create'])->name('admin.travelerType.create');
Route::post('/admin/travelerType/update/{id}', [TravelerTypeController::class, 'update'])->name('admin.travelerType.update');


//Prices

Route::get('/admin/prices', [PriceController::class, 'index'])->name('admin.price.index');
Route::post('/admin/prices/create', [PriceController::class, 'create'])->name('admin.class.create');
Route::post('/admin/prices/update/admin/{id}', [ClassesController::class, 'staffUpdate'])->name('admin.price.staffUpdate');



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

// Agent Booking Start Here
Route::get('/dashboard/booking', [AgentBookingController::class, 'index'])->name('agent.booking.index')->middleware('agent');
Route::post('/dashboard/booking', [AgentBookingController::class, 'search'])->name('agent.booking.search')->middleware('agent');
Route::get('/dashboard/booking/{destination}/{date}/{return}/{return_date}', [AgentBookingController::class, 'store'])->name('agent.booking.store')->middleware('agent');

// Agent Notifications Start Here
Route::get('/dasboard/notification', [NotificationController::class, 'index'])->name('agent.notification.index')->middleware('agent');
Route::get('/dasboard/notification/{id}', [NotificationController::class, 'show'])->name('agent.notification.store')->middleware('agent');

Route::get('/dasboard/notification/{id}/request', [ShowNotificationController::class, 'wallet_request'])->name('agent.notification.wallet.request')->middleware('agent');
Route::get('/dasboard/notification/{id}/close', [ShowNotificationController::class, 'wallet_close'])->name('agent.notification.wallet.close')->middleware('agent');
Route::get('/dasboard/notification/{id}/open', [ShowNotificationController::class, 'wallet_open'])->name('agent.notification.wallet.open')->middleware('agent');

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
