<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DealController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Cache;
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


Route::middleware("auth")->group(function (){

    Route::get('/', [HomeController::class, 'homePage'])->name('home');

    Route::prefix("leads")->group(function () {
        Route::get('/', [LeadController::class, 'index']);
        Route::get('/import', [LeadController::class, 'import'])->name('lead.import');
        Route::get('/{lead}/edit', [LeadController::class, 'edit'])->name('lead.edit');
        Route::patch('/{lead}', [LeadController::class, 'update'])->name('lead.update');
    });

    Route::prefix("deals")->group(function () {
        Route::controller(DealController::class)->group(function () {
            Route::get('/', 'index')->name('deal.index');
            Route::get('/{deal}/edit', 'edit')->name('deal.edit');
            Route::patch('/{deal}', 'update')->name('deal.update');
            Route::get('/{deal}', 'confirm')->name('deal.show');
            Route::get('/{deal}/confirm', 'closeDeal')->name('deal.confirm');
            Route::get('/{deal}/reject', 'rejectDeal')->name('deal.reject');
            Route::patch('/reject/{deal}', 'rejectAndClose')->name('deal.close');
            Route::get('/{deal}/about', 'aboutDeal')->name('deal.about');
        });

        Route::controller(TaskController::class)->group(function () {
            Route::get('{deal}/tasks/create', 'create')->name('task.create');
            Route::post('{deal}/tasks', 'store')->name('task.store');
            Route::get('{deal}/tasks/success', 'success')->name('task.success');
        });
    });

    Route::middleware("manager.forbidden")->group(function (){
        Route::prefix("companies")->group(function () {
            Route::controller(CompanyController::class)->group(function () {
                Route::get('/', 'index')->name('company.index');
                Route::get('/create', 'create')->name('company.create')->middleware('admin.permission');
                Route::post('/', 'store')->name('company.store');
                Route::get('/{company}/edit', 'edit')->name('company.edit')->middleware('admin.permission');
                Route::patch('/{company}', 'update')->name('company.update');
                Route::get('/{company}', 'show')->name('company.show');
                Route::delete('/{company}', 'destroy')->name('company.destroy');
            });
        });
    
        Route::prefix("products")->group(function () {
            Route::controller(ProductController::class)->group(function () {
                Route::get('/', 'index')->name('product.index');
                Route::get('/create', 'create')->name('product.create')->middleware('admin.permission');
                Route::post('/','store')->name('product.store');
                Route::get('/{product}/edit', 'edit')->name('product.edit')->middleware('admin.permission');
                Route::patch('/{product}', 'update')->name('product.update');
                Route::get('/{product}', 'show')->name('product.show');
                Route::delete('/{product}', 'destroy')->name('product.destroy');
            });
        });
    });
    
    Route::get('autocomplete', [DealController::class, 'autocomplete'])->name('autocomplete');

    Route::get('/tasks', [TaskController::class, 'index'])->name('task.index');

});

Auth::routes();

