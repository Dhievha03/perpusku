<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BookCategoryController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Page\HomeController;
use App\Http\Controllers\User\AuthController as UserAuthController;
use App\Http\Controllers\User\BookController as UserBookController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\ProfileController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [UserAuthController::class, 'login'])->name('user.login');
Route::post('/authenticate', [UserAuthController::class, 'authenticate'])->name('user.authenticate');

Route::get('/register', [UserAuthController::class, 'register'])->name('user.register');
Route::post('/register', [UserAuthController::class, 'registerStore'])->name('user.register.store');

Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
        Route::get('/logout', [UserAuthController::class, 'logout'])->name('logout');

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

        Route::group(['prefix' => 'book', 'as' => 'book.'], function () {
            Route::get('/', [UserBookController::class, 'index'])->name('index');
            Route::get('/create', [UserBookController::class, 'create'])->name('create');
            Route::post('/create', [UserBookController::class, 'store'])->name('store');
            Route::get('/edit/{book}', [UserBookController::class, 'edit'])->name('edit');
            Route::put('/{book}', [UserBookController::class, 'update'])->name('update');
            Route::get('/detail/{book}/{slug}', [UserBookController::class, 'show'])->name('show');
            Route::delete('/{book}', [UserBookController::class, 'destroy'])->name('delete');
            Route::get('/get-books', [UserBookController::class, 'getBooks'])->name('getBooks');
            Route::get('/export-excel', [UserBookController::class, 'exportExcel'])->name('exportExcel');
            Route::get('/export-pdf', [UserBookController::class, 'exportPdf'])->name('exportPdf');
        });
    });
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    // Auth
    Route::get('/login', [AuthController::class, 'index'])->middleware('guest')->name('login');
    Route::post('/login/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');

    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::group(['prefix' => 'book-categories', 'as' => 'bookCategories.'], function () {
            Route::get('/', [BookCategoryController::class, 'index'])->name('index');
            Route::post('/store', [BookCategoryController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [BookCategoryController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [BookCategoryController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [BookCategoryController::class, 'destroy'])->name('delete');
            Route::get('/get-book-categories', [BookCategoryController::class, 'getBookCategories'])->name('getBookCategories');
        });

        Route::group(['prefix' => 'book', 'as' => 'book.'], function () {
            Route::get('/', [BookController::class, 'index'])->name('index');
            Route::get('/create', [BookController::class, 'create'])->name('create');
            Route::post('/create', [BookController::class, 'store'])->name('store');
            Route::get('/edit/{book}', [BookController::class, 'edit'])->name('edit');
            Route::put('/{book}', [BookController::class, 'update'])->name('update');
            Route::get('/detail/{book}/{slug}', [BookController::class, 'show'])->name('show');
            Route::delete('/{book}', [BookController::class, 'destroy'])->name('delete');
            Route::get('/get-books', [BookController::class, 'getBooks'])->name('getBooks');
            Route::get('/export-excel', [BookController::class, 'exportExcel'])->name('exportExcel');
            Route::get('/export-pdf', [BookController::class, 'exportPdf'])->name('exportPdf');
        });
    });
});