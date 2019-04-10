<?php

Route::get('/lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LocaleController@switchLang']);

/**
 * INDEX
 */
Route::get('/', 'Frontend\PageController@index');

Route::get('/maintenance', function ()
{
    return view('maintenance');
})->name('maintenance');

/**
 * about
 */
 Route::group(['prefix' => 'about'], function()
 {
    Route::get('/', 'Frontend\PageController@about')->name('about');
    Route::get('/privacy', 'Frontend\PageController@privacy')->name('privacy');
    Route::get('/remind', 'Frontend\PageController@remind')->name('remind');
    Route::get('/notice', 'Frontend\PageController@notice')->name('notice');
 });

/**
 * PRODUCT
 */
// Route::get('/product-detail/{guid}', 'Frontend\ProductController@getByGuid');
// Route::get('/product-detail/{id}/show', 'Frontend\ProductController@productDetailFromId');
Route::get('/product-detail/{guid}', 'Frontend\ProductController@productDetailFromPath')->name('productDetail');
Route::get('/product', 'Frontend\PageController@productAll');
Route::get('/product/category/{guid}', 'Frontend\ProductController@productCategory');

/**
 * Post
 */
Route::get('/blog', function ()
{
    return view('frontend.blog.list', [
        'isThumbShow' => false,
    ]);
})->name('blog');
Route::get('blog/category/{category}', function ($category)
{
    return view('frontend.blog.category', [
        'isThumbShow' => false,
        'category' => $category
    ]);
});
Route::get('/blog/{id}/detail', function ($id)
{
    return view('frontend.blog.post', [
        'post' => PostView::getById($id),
        'isThumbShow' => false,
    ]);
});
Route::get('/blog/{path}', function ($path)
{
    return view('frontend.blog.post', [
        'post' => PostView::getByPath($path),
        'isThumbShow' => false,
    ]);
});

/**
 * MEMBER
 */
Route::get('/login', 'Frontend\PageController@login');
Route::get('/register', 'Frontend\PageController@register');
Route::get('/forget-password', function ()
{
    return view('frontend.authentication.forgetPassword', [
        'isThumbShow' => false,
    ]);
});
Route::get('/reset-password/{token}', 'Frontend\UserController@resetPasswordPage');

/**
 * DASHBOARD
 */
Route::group(['prefix' => 'user', 'middleware' => 'checkUser'], function()
{
    Route::get('/', 'Frontend\DashboardController@index');
    Route::get('/address', 'Frontend\DashboardController@address');
    Route::get('/information', 'Frontend\DashboardController@information');
    Route::post('/modifyInformation', 'Frontend\DashboardController@modifyInformation');
});

/**
 * BUSINESS LOGIC
 */
Route::group(['middleware' => 'auth'], function ()
{
    Route::get('/checkout', 'Frontend\BuisnessController@checkout');
    Route::get('/order', 'Frontend\BuisnessController@order');
    /**
     * trans to checkout
     */

    Route::get('/checkout/getPoint', 'Frontend\BuisnessController@getPoint');
});
Route::post('/checkout/billing', 'Frontend\BuisnessController@transToCheckout');
Route::get('/cart', 'Frontend\BuisnessController@cart');
Route::post('/orderChecking', 'Frontend\BuisnessController@orderChecking')->name('orderChecking');
Route::get('/check-order', function ()
{
    return view('frontend.checkoutMethod.checkOrder', [
        'isThumbShow' => false,
        'thumb' => null
    ]);
});
Route::get('/remittance-information', function ()
{
    return view('frontend.checkoutMethod.remittanceInformation', [
        'isThumbShow' => false,
        'thumb' => null
    ]);
});

/**
 * CONTACT
 */
Route::get('/contact', 'Frontend\PageController@contact')->name('contact');

/**
 * Search
 */
Route::post('/search-option', 'Frontend\SearchController@searchProduct');
Route::get('/importScout', 'Frontend\SearchController@importScout');

/**
 * Captcha
 */
Route::get('/captcha', 'HomeController@captcha');
Route::get('/cap_str', 'HomeController@getString');

/**
 * Partners
 */
Route::get('/partners', 'Frontend\PageController@partners');

/**
 * test area
 */
// Route::get('/ga-test', 'HomeController@gaTest');

// Route::get('/hppe-test', function() {
//     return view('test', [
//         'order' => str_random(6)
//     ]);
// });

// Route::get('/test-area', function ()
// {
//     return view('test', [
//         'title' => 'test',
//         'shortcut' => '',
//         'product' => [],
//         'post' => [],
//         'isThumbShow' => false,
//         'thumb' => null
//     ]);
// });
// Route::post('/test-post', 'HomeController@testPost');
// Route::get('/test-action', 'HomeController@testAction');
// Route::get('/truncate', 'HomeController@truncate');
