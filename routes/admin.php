<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AttributeValueController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

#admin routes
Route::post('/upload', [UploadController::class, 'store'])->name('upload.store');

Route::get('/files/{file_id}', [FileController::class, 'index'])
    ->name("file.show");

Route::get('/files/draft/{file_id}', [FileController::class, 'draft'])
    ->name("file.draft.show");

Route::get('/delete/{file_id}/draft', [FileController::class, 'delete'])
    ->name("file.draft.delete");

Route::prefix('admin')->group(function () {
    #Dashboard
    Route::get('', [HomeController::class, 'index'])
        ->name('admin.dashboard');

    #Attributes
    Route::get('attributes', [AttributeController::class, 'index'])
        ->name('admin.attributes.index');

    Route::get('attributes/create', [AttributeController::class, 'create'])
        ->name('admin.attributes.create');

    Route::post('attributes/create', [AttributeController::class, 'store'])
        ->name('admin.attributes.store');

    Route::get('attributes/edit/{id}', [AttributeController::class, 'edit'])
        ->name('admin.attributes.edit');

    Route::post('attributes/update/{id}', [AttributeController::class, 'update'])
        ->name('admin.attributes.update');

    Route::delete('attributes/delete/{id}', [AttributeController::class, 'delete'])
        ->name('admin.attributes.delete');

    #Attribute Values
    Route::get('attribute-values', [AttributeValueController::class, 'index'])
        ->name('admin.attribute_values.index');

    Route::get('attribute-values/create', [AttributeValueController::class, 'create'])
        ->name('admin.attribute_values.create');

    Route::post('attribute-values/create', [AttributeValueController::class, 'store'])
        ->name('admin.attribute_values.store');

    Route::get('attribute-values/edit/{id}', [AttributeValueController::class, 'edit'])
        ->name('admin.attribute_values.edit');

    Route::post('attribute-values/update/{id}', [AttributeValueController::class, 'update'])
        ->name('admin.attribute_values.update');

    Route::delete('attribute-values/delete/{id}', [AttributeValueController::class, 'delete'])
        ->name('admin.attribute_values.delete');

    #Categories
    Route::get('categories', [CategoryController::class, 'index'])
        ->name('admin.categories.index');

    Route::get('categories/create', [CategoryController::class, 'create'])
        ->name('admin.categories.create');

    Route::post('categories/create', [CategoryController::class, 'store'])
        ->name('admin.categories.store');

    Route::get('categories/edit/{id}', [CategoryController::class, 'edit'])
        ->name('admin.categories.edit');

    Route::post('categories/update/{id}', [CategoryController::class, 'update'])
        ->name('admin.categories.update');

    Route::delete('categories/delete/{id}', [CategoryController::class, 'delete'])
        ->name('admin.categories.delete');

    #Products
    Route::get('/products', [ProductController::class, 'index'])
        ->name('admin.products.index');

    Route::get('/products/create', [ProductController::class, 'create'])
        ->name('admin.products.create');

    Route::post('/products/create', [ProductController::class, 'store'])
        ->name('admin.products.store');

    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])
        ->name('admin.products.edit');

    Route::post('/products/edit/{id}', [ProductController::class, 'update'])
        ->name('admin.products.update');

    Route::delete('/products/delete/{id}', [ProductController::class, 'delete'])
        ->name('admin.products.delete');

    #Product Variants
    Route::get('/product-variants', [ProductVariantController::class, 'index'])
        ->name('admin.product_variants.index');

    Route::get('/product-variants/create', [ProductVariantController::class, 'create'])
        ->name('admin.product_variants.create');

    Route::post('/product-variants/create', [ProductVariantController::class, 'store'])
        ->name('admin.product_variants.store');

    Route::get('/product-variants/edit/{id}', [ProductVariantController::class, 'show'])
        ->name('admin.product_variants.show');

    Route::post('/product-variants/edit/{id}', [ProductVariantController::class, 'update'])
        ->name('admin.product_variants.update');

    Route::get('/product-variants/delete/{id}', [ProductVariantController::class, 'delete'])
        ->name('admin.product_variants.delete');

    Route::get('ajax/attribute-value', [App\Http\Controllers\AjaxController::class, 'getAttributeValue'])
        ->name('admin.ajaxGetAttributeValue');

    #Banners
    Route::get('banners', [BannerController::class, 'index'])
        ->name('admin.banners.index');

    Route::get('banners/create', [BannerController::class, 'create'])
        ->name('admin.banners.create');

    Route::post('banners/create', [BannerController::class, 'store'])
        ->name('admin.banners.store');

    Route::get('banners/edit/{id}', [BannerController::class, 'show'])
        ->name('admin.banners.show');

    Route::post('banners/update/{id}', [BannerController::class, 'update'])
        ->name('admin.banners.update');

    Route::get('banners/delete/{id}', [BannerController::class, 'delete'])
        ->name('admin.banners.delete');
});


