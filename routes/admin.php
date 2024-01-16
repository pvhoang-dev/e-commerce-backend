<?php

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

    #Home page product
    Route::post('/add_home_page_product', [HomePageController::class, 'addHomePage'])
        ->name('add_home_page');

    #Product Variants
    Route::get('/product-variants', [ProductVariantController::class, 'index'])
        ->name('admin.product_variants.index');

    Route::get('/product-variants/create', [ProductVariantController::class, 'create'])
        ->name('admin.product_variants.create');

    Route::post('/product-variants/create', [ProductVariantController::class, 'store'])
        ->name('admin.product_variants.store');

    Route::get('/product-variants/edit/{id}', [ProductVariantController::class, 'edit'])
        ->name('admin.product_variants.edit');

    Route::post('/product-variants/edit/{id}', [ProductVariantController::class, 'update'])
        ->name('admin.product_variants.update');

    Route::delete('/product-variants/delete/{id}', [ProductVariantController::class, 'delete'])
        ->name('admin.product_variants.delete');

    #Banners
    Route::get('banners', [BannerController::class, 'index'])
        ->name('admin.banners.index');

    Route::get('banners/create', [BannerController::class, 'create'])
        ->name('admin.banners.create');

    Route::post('banners/create', [BannerController::class, 'store'])
        ->name('admin.banners.store');

    Route::get('banners/edit/{id}', [BannerController::class, 'edit'])
        ->name('admin.banners.edit');

    Route::post('banners/update/{id}', [BannerController::class, 'update'])
        ->name('admin.banners.update');

    Route::delete('banners/delete/{id}', [BannerController::class, 'delete'])
        ->name('admin.banners.delete');

    #Brands
    Route::get('brands', [BrandController::class, 'index'])
        ->name('admin.brands.index');

    Route::get('brands/create', [BrandController::class, 'create'])
        ->name('admin.brands.create');

    Route::post('brands/create', [BrandController::class, 'store'])
        ->name('admin.brands.store');

    Route::get('brands/edit/{id}', [BrandController::class, 'edit'])
        ->name('admin.brands.edit');

    Route::post('brands/update/{id}', [BrandController::class, 'update'])
        ->name('admin.brands.update');

    Route::delete('brands/delete/{id}', [BrandController::class, 'delete'])
        ->name('admin.brands.delete');

    #Menus
    Route::get('menus', [MenuController::class, 'index'])
        ->name('admin.menus.index');

    Route::get('menus/create', [MenuController::class, 'create'])
        ->name('admin.menus.create');

    Route::post('menus/create', [MenuController::class, 'store'])
        ->name('admin.menus.store');

    Route::get('menus/edit/{id}', [MenuController::class, 'edit'])
        ->name('admin.menus.edit');

    Route::post('menus/update/{id}', [MenuController::class, 'update'])
        ->name('admin.menus.update');

    Route::delete('menus/delete/{id}', [MenuController::class, 'delete'])
        ->name('admin.menus.delete');

    #Locations
    Route::get('locations', [LocationController::class, 'index'])
        ->name('admin.locations.index');

    Route::post('locations/create', [LocationController::class, 'store'])
        ->name('admin.locations.create');

    #Ajax
    Route::get('ajax/attribute-value', [App\Http\Controllers\Admin\AjaxController::class, 'getAttributeValue'])
        ->name('admin.ajaxGetAttributeValue');
});


