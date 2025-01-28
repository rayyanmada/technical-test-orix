<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\MerkController;

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

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/fganti_psswrd', [HomeController::class, 'fganti_psswrd'])->name('fganti_psswrd');
Route::put('/update_psswrd/{user}', [HomeController::class, 'update_psswrd'])->name('update_psswrd');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('inventory', InventoryController::class);
    Route::resource('order', OrderController::class);
    Route::resource('finishorder', PengembalianController::class);
    Route::resource('invoice', InvoiceController::class);
    Route::resource('driver', DriverController::class);
    Route::resource('merk', MerkController::class);

    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/getphoto', [InventoryController::class, 'getphoto']);
    Route::get('/getcustomer', [CustomerController::class, 'getcustomer']);
    Route::get('/getinventory', [InventoryController::class, 'getinventory']);
    Route::get('/cetakinv/{no_inv}', [InvoiceController::class, 'cetak']);

    Route::get('/pengembalian/{order_id}', [OrderController::class, 'pengembalian']);
    Route::get('/invoicing/{id}', [PengembalianController::class, 'invoicing'])->name('report.invoicing');
    Route::get('/approval/{order_id}', [OrderController::class, 'approval']);
});
