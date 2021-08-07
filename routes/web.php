<?php

use App\Http\Controllers\Category;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\MultipicController;

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

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all();
    $users = DB::table('users')->get();

    return view('admin.dashboard', compact('users'));
})->name('dashboard');

Route::middleware(['auth'])->group(function () {

//Brands
Route::resource('brands', BrandController::class)->middleware('auth');

//Multi Pics
Route::get('pics', [MultipicController::class, 'showPics'])->name('pics.index');
Route::post('pics', [MultipicController::class, 'storePics'])->name('pics.store');

//Categories
Route::resource('categories', CategoryController::class);
Route::get('categories/restore/{id}', [CategoryController::class, 'restore'])->name('categories.restore');
Route::get('categories/p-delete/{id}', [CategoryController::class, 'permanentDelete'])->name('categories.p-delete');

});

