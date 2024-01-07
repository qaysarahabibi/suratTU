<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\LetterTypeController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
    return view('dashboard');
})->name('dashboard');

// Route::middleware('IsGuest')->group(function () {
//     // method login ini berpengaruh pada method setelahnya
//     Route::get('/', function () {
//         return view('login');
//     })->name('login');
//     Route::post('/login', [UserController::class, 'authLogin'])->name('auth-login');
// });

// Route::middleware('IsLogin')->group(function () {

//     Route::get('/logout', [UserController::class, 'logout'])->name('auth-logout');
//     Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
// });

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
// Route::middleware('IsStaff')->group(function () {
    Route::prefix('/staff')->name('staff.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        // Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::get('/{id}', [UserController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('delete');
        // Route::get('/search',[UserController::class, 'search'])->name('search'); 
    });

    Route::prefix('/guru')->name('guru.')->group(function () {
        Route::get('/', [UserController::class, 'indexGuru'])->name('indexGuru');
        Route::get('/create', [UserController::class, 'createGuru'])->name('createGuru');
        Route::post('/store', [UserController::class, 'storeGuru'])->name('storeGuru');
        Route::get('/{id}', [UserController::class, 'editGuru'])->name('editGuru');
        Route::patch('/{id}', [UserController::class, 'updateGuru'])->name('updateGuru');
        Route::delete('/{id}', [UserController::class, 'destroyGuru'])->name('deleteGuru');
    });

    Route::prefix('/klasifikasi')->name('klasifikasi.')->group(function () {
        Route::get('/', [LetterTypeController::class, 'index'])->name('index');
        Route::get('/create', [LetterTypeController::class, 'create'])->name('create');
        Route::post('/store', [LetterTypeController::class, 'store'])->name('store');
        // Route::get('/{id}/edit', [LetterTypeController::class, 'edit'])->name('edit');
        Route::get('/{id}', [LetterTypeController::class, 'edit'])->name('edit');
        Route::get('/{id}/show', [LetterTypeController::class, 'show'])->name('show');
        Route::patch('/{id}', [LetterTypeController::class, 'update'])->name('update');
        Route::delete('/{id}', [LetterTypeController::class, 'destroy'])->name('delete');
        Route::get('/download/{id}', [LetterTypeController::class, 'downloadPDF'])->name('download');
    });

    Route::prefix('/surat')->name('surat.')->group(function () {
        Route::get('/index', [LetterController::class, 'index'])->name('index');
        Route::get('/create', [LetterController::class, 'create'])->name('create');
        Route::post('/store', [LetterController::class, 'store'])->name('store');
        Route::get('/{id}', [LetterController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [LetterController::class, 'update'])->name('update');
        Route::delete('/{id}', [LetterController::class, 'destroy'])->name('delete');
        Route::get('/{id}/show', [LetterController::class, 'show'])->name('show');

    });

    Route::prefix('/result')->name('result.')->group(function () {
        // Route::get('/', [ResultController::class, 'index'])->name('index');
        Route::get('/create', [ResultController::class, 'create'])->name('create');
        Route::post('/store', [ResultController::class, 'store'])->name('store');
        Route::post('/result/store', [ResultController::class, 'store'])->name('result.store');

    });


// });





