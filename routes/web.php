<?php

use App\Http\Controllers\AutomaticAttendanceController;
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

Route::get('/', [AutomaticAttendanceController::class, 'index'])->name('index');
Route::post('/register', [AutomaticAttendanceController::class, 'register'])->name('register');
