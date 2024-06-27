<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CataloguesController;
use App\Http\Controllers\Admin\ProductsController;


Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::prefix('catalogues')->as('catalogues.')->group(function () {
        Route::get('/', [CataloguesController::class, 'index'])->name('index');
        Route::get('create', [CataloguesController::class, 'create'])->name('create');
         Route::post('store', [CataloguesController::class,'store'])->name('store');
        Route::get('show/{id}', [CataloguesController::class,'show'])->name('show');
        Route::get('{id}/edit', [CataloguesController::class, 'edit'])->name('edit');
        Route::put('{id}/update', [CataloguesController::class, 'update'])->name('update');
        Route::delete('destroy/{id}', [CataloguesController::class, 'destroy'])->name('destroy');
    });
    Route::resource('products', ProductsController::class);
});

