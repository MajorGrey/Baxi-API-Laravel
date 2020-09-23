<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [Controller::class, 'index']);
Route::get('/dstv', [Controller::class, 'dstv']);
Route::post('/dstv/pay', [Controller::class, 'dstv_pay']);
Route::get('/dstv/{id}', [Controller::class, 'dstv_id']);
Route::get('/ekedc', [Controller::class, 'ekedc']);
Route::post('/ekedc/pay', [Controller::class, 'ekedc_pay']);
Route::get('/ekedc/{id}/{no}', [Controller::class, 'ekedc_id']);
