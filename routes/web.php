<?php

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\admin\productsController;
use App\Http\Controllers\admin\ProductSubCategoryController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\TempImageController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


//////// User routes

route::get('/',[FrontController::class,'index'])->name('user.home');

///// Shop ///

route::get('/shop/{categorySlug?}/{subcategorySlug?}',[ShopController::class,'index'])->name('user.shop');
route::get('/product/{slug}',[ShopController::class,'product'])->name('user.product');

/////// Cart


Route::get('/add_cart',[CartController::class,'cart'])->name('user.cart');




///////////////// Admin Routes
Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {
        route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login');
        route::post('/authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
    });
    Route::group(['middleware' => 'admin.auth'], function () {
        route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
        route::get('/logout', [HomeController::class, 'logout'])->name('admin.logout');

        // categories
        route::get('/categories', [CategoryController::class,'index'])->name('admin.category.index');
        route::get('/category/create', [CategoryController::class,'create'])->name('admin.category.create');
        route::post('/category/create', [CategoryController::class,'store'])->name('admin.category.store');
        route::get('/category/{id}/edit', [CategoryController::class,'edit'])->name('admin.category.edit');
        route::post('/category/update', [CategoryController::class,'update'])->name('admin.category.update');
        route::get('/category/{id}/delete', [CategoryController::class,'delete'])->name('admin.category.delete');

        /// Sub_category

        route::get('/sub-categories', [SubCategoryController::class,'index'])->name('admin.sub-category.index');
        route::get('/sub-category/create/', [SubCategoryController::class,'create'])->name('admin.sub-category.create');
        route::post('/sub-category/create/', [SubCategoryController::class,'store'])->name('admin.sub-category.store');
        route::get('/sub-category/{id}/edit', [SubCategoryController::class,'edit'])->name('admin.sub_category.edit');
        route::post('/sub-category/update', [SubCategoryController::class,'update'])->name('admin.sub_category.update');
        route::get('/sub-category/{id}/delete', [SubCategoryController::class,'delete'])->name('admin.sub_category.delete');
        //// Brand

        route::get('/brands', [BrandController::class,'index'])->name('admin.brand.index');
        route::get('/brands/create', [BrandController::class,'create'])->name('admin.brand.create');
        route::post('/brands/create', [BrandController::class,'store'])->name('admin.brand.store');
        route::get('/brands/{id}/edit', [BrandController::class,'edit'])->name('admin.brand.edit');
        route::post('/brands/update', [BrandController::class,'update'])->name('admin.brands.update');
        route::get('/brands/{id}/delete', [BrandController::class,'delete'])->name('admin.brand.delete');

        //// products
        // route::get('/brands', [BrandController::class,'index'])->name('admin.brand.index');
        route::get('/products', [productsController::class,'index'])->name('admin.product.index');
        route::get('/products/create', [productsController::class,'create'])->name('admin.product.create');
        route::get('/products/edit/{id}', [productsController::class,'edit'])->name('admin.product.edit');
        route::post('/products/update', [productsController::class,'update'])->name('admin.product.update');
        route::get('/products/delete/{id}', [productsController::class,'delete'])->name('admin.product.delete');
        route::post('/products/store', [productsController::class,'store'])->name('admin.product.store');

        route::get('/products-subcategory', [ProductSubCategoryController::class,'index'])->name('admin.products-subcategory.index');

        // temp image
        route::post('/products/image', [TempImageController::class,'create'])->name('admin.product-image.create');

    });
});
