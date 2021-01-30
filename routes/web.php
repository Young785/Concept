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
Route::get("/", "MainController@home");

Route::get("/pages/login", "AdminController@loginPage");
Route::get("/pages/login/verify/verificationId={id}", "AdminController@loginPage");
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


//Vendor Page 

Route::group(['prefix' => '/vendor/'], function () {
    Route::get("/", "VendorController@index")->middleware("vendor");
    Route::get("account", "VendorController@account")->middleware("vendor");
    Route::patch("account", "VendorController@editAccount")->middleware("vendor");
    Route::get("customers-order", "VendorController@custOrderPage")->middleware("vendor");
    Route::get("customers-order/{id}", "VendorController@orderPage")->middleware("vendor");
    Route::post("customers-order/{id}", "VendorController@completeOrder")->middleware("vendor");

    Route::get("categories", "VendorController@categories")->middleware("vendor");
    Route::get("vendor-categories", "VendorController@myCat")->middleware("vendor");
    Route::get("add-category", "VendorController@addCategoryPage")->middleware("vendor");
    Route::post("add-category", "VendorController@addCategory")->middleware("vendor");
    Route::delete("categories/{id}", "VendorController@deleteCategory")->middleware("vendor");
    Route::patch("categories/edit/{id}", "VendorController@editCategory")->middleware("vendor");

    Route::get("products", "VendorController@products")->middleware("vendor");
    Route::get("vendor-products", "VendorController@myProducts")->middleware("vendor");
    Route::get("add-products", "VendorController@addProductsPage")->middleware("vendor");
    Route::post("add-products", "VendorController@addProducts")->middleware("vendor");
    Route::delete("products/{id}", "VendorController@deleteProduct")->middleware("vendor");
    Route::patch("products/edit/{id}", "VendorController@editProduct")->middleware("vendor");
    
});
// Main Page

Route::group(['prefix' => '/main/'], function () {
    Route::get('register', "MainController@registerPage");
    Route::post('register', "MainController@register");
    Route::get('verify', "MainController@verifyPage");
    Route::get('verify/verificationId={hash}', "MainController@verify");
    Route::get('login', "MainController@loginPage");
    Route::post('login', "MainController@login");
    Route::get('forgot-password', "MainController@forgotPage");
    Route::get('forgot-password/reset-pass', "MainController@resetPass");
    Route::get('forgot-password/reset-password={id}', "MainController@resetPassword");
    Route::post('forgot-password/reset-password/email={email}', "MainController@reset");

    Route::get('category/{slug}', "MainController@catSlug");
    Route::get('category/{slug}/product/{id}', "MainController@fullDetails");
    Route::get('cart', "MainController@cart");
    Route::get('add-to-cart/{id}', 'MainController@addToCart');
    Route::patch('update-cart', "MainController@editCart");
    Route::delete('cart/{id}', "MainController@delCart");
    Route::post('cart/{id}', "MainController@savePage");


    Route::get('about', "MainController@about");
    Route::get('career', "MainController@career");
    Route::get('blog', "MainController@blog");
    Route::get('category/{slug}/{id}', "MainController@proDetails");
    Route::get('partner', "MainController@partner");
    Route::get('partner', "MainController@partner");
    Route::get('vendors', "MainController@vendor");

    Route::any('search', "MainController@search");
});


Route::group(['prefix' => '/account/'], function () {
    Route::get('/', "MainController@index")->middleware("users");
    Route::delete('/{id}', "MainController@delFav")->middleware("users");


    Route::get('/re_order', "MainController@re_order")->middleware("users");
    Route::get('/profile', "MainController@profile")->middleware("users");
    Route::get('/order_history', "MainController@orderHistory")->middleware("users");
    Route::get('/address', "MainController@addressPage")->middleware("users");
    Route::get('/payment', "MainController@paymentPage")->middleware("users");
    Route::get('/com_preference', "MainController@comprePage")->middleware("users");
});

Route::get('/markAsRead', function () {
    auth()->user()->unreadNotifications->markAsRead();
    return redirect("/");
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
