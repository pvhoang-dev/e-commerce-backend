<?php

use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\HomePageController;
use Illuminate\Support\Facades\Route;

#admin routes
Route::post('/upload', [UploadController::class, 'store'])
    ->name('upload.store');

Route::post('/upload-image', [UploadController::class, 'uploadImageTinyCloud']);

Route::get('/files/{file_id}', [FileController::class, 'index'])
    ->name("file.show");

Route::get('/files/draft/{file_id}', [FileController::class, 'draft'])
    ->name("file.draft.show");

Route::get('/delete/{file_id}/draft', [FileController::class, 'delete'])
    ->name("file.draft.delete");

Route::prefix('admin')->name('admin.')->group(function () {

    #Dashboard
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');

    #Attributes
    Route::prefix('attributes')->controller(AttributeController::class)->name('attributes.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'delete')->name('delete');
    });

    #Attribute Values
    Route::prefix('attribute-values')->controller(AttributeValueController::class)->name('attribute_values.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'delete')->name('delete');
    });

    #Categories
    Route::prefix('categories')->controller(CategoryController::class)->name('categories.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'delete')->name('delete');
    });

    #Products
    Route::prefix('products')->controller(ProductController::class)->name('products.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'delete')->name('delete');
        Route::post('/store-description', 'storeDescription')->name('store_description');
    });

    #Product Variants
    Route::prefix('product-variants')->controller(ProductVariantController::class)->name('product_variants.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'delete')->name('delete');
    });

    #Banners
    Route::prefix('banners')->controller(BannerController::class)->name('banners.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'delete')->name('delete');
    });

    #Brands
    Route::prefix('brands')->controller(BrandController::class)->name('brands.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'delete')->name('delete');
    });

    #Menus
    Route::prefix('menus')->controller(MenuController::class)->name('menus.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'delete')->name('delete');
    });


    #Home page product
    Route::post('/add_home_page_product', [HomePageController::class, 'addHomePage'])->name('add_home_page');

    #Locations
    Route::get('/locations', [LocationController::class, 'index'])
        ->name('locations.index');

    Route::post('/locations/create', [LocationController::class, 'store'])
        ->name('locations.create');

    #Ajax
    Route::get('ajax/attribute-value', [AjaxController::class, 'getAttributeValue'])
        ->name('ajaxGetAttributeValue');
});
