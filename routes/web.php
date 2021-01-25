<?php

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
Route::get("/pages/login", "AdminController@loginPage");
Route::post("/pages/login", "AdminController@login");
Route::get("/pages/register", "AdminController@registerPage");
Route::post("/pages/register", "AdminController@register");
Route::get('/logout', function () {
    Auth::logout();

    return redirect("/");
});

Route::group(['prefix' => '/admin'], function () {
    Route::get("/", "AdminController@index")->middleware("access");
    Route::get("/account", "AdminController@account")->middleware("access");
    Route::patch("/account", "AdminController@editAcc")->middleware("access");

    Route::get("/customers", "AdminController@users")->middleware("access");
    Route::delete("/customers/{id}", "AdminController@delUsers")->middleware("access");
    Route::post("/customers/{id}", "AdminController@makeVendor")->middleware("access");

    Route::post("/vendors/{id}", "AdminController@unmakeVendor")->middleware("access");

    Route::get("/vendors", "AdminController@vendors")->middleware("access");

    Route::get("/categories", "AdminController@categories")->middleware("access");
    Route::get("/add-category", "AdminController@addCategoryPage")->middleware("access");
    Route::post("/add-category", "AdminController@addCategory")->middleware("access");
    Route::delete("/categories/{id}", "AdminController@deleteCategory")->middleware("access");
    Route::patch("/categories/edit/{id}", "AdminController@editCategory")->middleware("access");

    Route::get("/products", "AdminController@products")->middleware("access");
    Route::get("/add-products", "AdminController@addProductsPage")->middleware("access");
    Route::post("/add-products", "AdminController@addProducts")->middleware("access");
    Route::delete("/products/{id}", "AdminController@deleteProduct")->middleware("access");
    Route::patch("/products/edit/{id}", "AdminController@editProduct")->middleware("access");

});

Route::get('/markAsRead', function () {
    auth()->user()->unreadNotifications->markAsRead();
    return redirect("/");
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
