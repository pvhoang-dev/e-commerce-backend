<?php
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


include('admin.php');

include('user.php');

\Illuminate\Support\Facades\Route::get('test', [\App\Http\Controllers\TestController::class, 'index'])->name('test');


