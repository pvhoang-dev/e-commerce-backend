<?php

use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FeatureCategoryController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\HomePageController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductFeatureController;
use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\Admin\UploadController;
use Illuminate\Support\Facades\Route;

#admin routes
Route::post('/upload', [UploadController::class, 'store'])
    ->name('upload.store');

Route::post('/upload-image', [UploadController::class, 'uploadImageTinyCloud']);

Route::get('/files/{file_id}', [FileController::class, 'index'])
    ->name("file.show");

Route::get('/files/draft/{file_id}', [FileController::class, 'draft'])
    ->name("file.draft.show");

Route::delete('/delete/{file_id}/draft', [FileController::class, 'deleteDraft'])
    ->name("file.draft.delete");

// Auth
Route::get('/admin/login', [LoginController::class, 'index'])
    ->name("admin.login");

Route::post('/admin/login', [LoginController::class, 'authenticate'])
    ->name("admin.login.authenticate");

Route::get('/admin/logout', [LogoutController::class, 'logout'])
    ->name("admin.logout");

Route::prefix('admin')->name('admin.')->middleware(['check_admin'])->group(
    function () {
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
            Route::post('/upload-images', 'uploadImages')->name('upload_images');
            Route::post('/delete-image', 'deleteImage')->name('delete_image');
            Route::post('/setup-position-images', 'setupPositionImages')->name('setup_position_images');
            Route::post('/update-status/{id}', 'updateStatus')->name('update_status');
        });

        #Product Variants
        Route::prefix('product-variants')->controller(ProductVariantController::class)->name('product_variants.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::delete('/delete/{id}', 'delete')->name('delete');
            Route::post('/update-discount/{id}', 'updateDiscount')->name('update_discount');
            Route::post('/update-status', 'updateStatus')->name('update_status');
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

        #Feature Categories
        Route::prefix('feature-categories')->controller(FeatureCategoryController::class)->name('feature_categories.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::delete('/delete/{id}', 'delete')->name('delete');
        });

        #Features
        Route::prefix('features')->controller(FeatureController::class)->name('features.')->group(function () {
            Route::post('/create', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update', 'update')->name('update');
            Route::delete('/delete/{id}', 'delete')->name('delete');
        });

        #Features
        Route::prefix('product-features')->controller(ProductFeatureController::class)->name('product_features.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/create', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update', 'update')->name('update');
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
        Route::get('ajax/feature', [AjaxController::class, 'getFeature'])
            ->name('ajaxGetFeature');
    });
