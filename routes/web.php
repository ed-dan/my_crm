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

//Route::get('/', function () {
//
//    /** @var \Illuminate\Cache\CacheManager $cache */
//    $cache = app()->make("cache");
//    //$cache->put("test", 132);
//    $cache = Cache();
//    dd($cache);
//    return 123;
//});


Route::middleware("auth")->group(function (){

    Route::get('/', [HomeController::class, 'homePage'])->name('home');

    Route::prefix("leads")->group(function () {
        Route::get('/', [LeadController::class, 'index']);
        Route::get('/import', [LeadController::class, 'import'])->name('lead.import');
        Route::get('/{lead}/edit', [LeadController::class, 'edit'])->name('lead.edit');
        Route::patch('/{lead}', [LeadController::class, 'openDeal'])->name('lead.update');
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

    Route::prefix("companies")->group(function () {
        Route::controller(CompanyController::class)->group(function () {
            Route::get('/', 'index')->name('company.index');
            Route::get('/create', 'create')->name('company.create');
            Route::post('/', 'store')->name('company.store');
            Route::get('/{company}', 'show')->name('company.show');
        });
    });

    Route::get('autocomplete', [DealController::class, 'autocomplete'])->name('autocomplete');

    Route::get('/tasks', [TaskController::class, 'index'])->name('task.index');

    Route::get('/products', [ProductController::class, 'index'])->name('product.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/products', [ProductController::class, 'store'])->name('product.store');

});

Auth::routes();

//Route::get('/reg',[DealController::class, 'reg'])->name('reg');
