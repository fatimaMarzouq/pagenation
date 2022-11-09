<?php

use App\Http\Controllers\ReservationController;
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
Route::get('/paginate', [ReservationController::class,'allReservationEP']);
Route::get('/data', [ReservationController::class,'fetchAllData']);
Route::delete('/deleteData/{id}', [ReservationController::class,'deleteData']);

