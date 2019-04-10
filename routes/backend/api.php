<?php



// Generate Dummy Data
Route::get('generateDumyNormalUser', 'Backend\AdminController@generateDumyNormalUser');
Route::get('generateDumyAdminUser', 'Backend\AdminController@generateDumyAdminUser');
Route::get('generateDumyPost', 'Backend\AdminController@generateDumyPost');

// For test
Route::get('/apitest', 'HomeController@test');
Route::get('/mailtest', 'Backend\MailController@sendMail');
// Route::post('/mailtest', 'Backend\MailController@sendMail');


/**
 * EC Pay checkout methods
 */
Route::get('/getCvsTarget', 'Backend\CheckoutController@getCvsTarget');
Route::post('/logistics_order_reply', 'Backend\CheckoutController@logistics_order_reply');
Route::post('/payment_info', 'Backend\OrderController@paymentInfo');
Route::post('/shop_option_reply', 'Backend\CheckoutController@shopReply');
Route::post('/cvs_map_callback', 'Backend\CheckoutController@callBackCvs');
Route::post('/order-payment', 'Backend\CheckoutController@orderPayment');
Route::post('/order-payment-dashboard/{guid}', 'Backend\CheckoutController@orderPaymentDashboard');
Route::post('/ecpay-return', 'Backend\OrderController@ecpayReturn');
Route::post('/logistics-return', 'Backend\OrderController@logisticsReturn');
Route::get('/order-success', 'Backend\OrderController@orderSuccess');
Route::get('/order/search/{merchantID}', 'Backend\OrderController@searchOrders');
Route::get('/order/get/{status}', 'Backend\OrderController@getOrders');
Route::post('/cvs-generate-sheet', 'Backend\CheckoutController@generateSheet');
Route::post('/re-generate-vAccount/{guid}', 'Backend\CheckoutController@reGenerateVAccount');
Route::post('/order/updateStatus', 'Backend\OrderController@updateOrderStatus');
Route::post('/order/updateRemark', 'Backend\OrderController@updateOrderRemark');


Route::group(['middleware' => 'auth'], function ()
{
    Route::post('/order/generate-cvs', 'Backend\CheckoutController@generateCvs');
    Route::post('/order/generate-sheet', 'Backend\CheckoutController@generateSheet');
});

Route::get('/check_test', 'Backend\CheckoutController@checkoutTest');

/**
 * shipping method
 */
Route::post('/admin/shipping/addShippingMethod', 'Backend\OrderController@addShippingMethod');
Route::post('/admin/shipping/editShippingMethod', 'Backend\OrderController@editShippingMethod');
Route::post('/admin/shipping/deleteShippingMethod/{id}', 'Backend\OrderController@deleteShippingMethod');
Route::get('/admin/shipping/getShippingMethods', 'Backend\OrderController@getShippingMethods');

/**
 * New Order
 */

Route::get('/admin/getNewOrder', 'Backend\OrderController@getNewOrder');


/**
 * Social Login Provider
 */
Route::get('auth/{provider}', 'Auth\RegisterController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');


/**
 * Admin
 */
Route::post('/admin/admin/add', 'Backend\AdminController@store');
Route::get('/admin/admin/list', 'Backend\AdminController@getAdminList');
Route::post('/admin/admin/update/{guid}', 'Backend\AdminController@updateAdmin');
Route::post('/admin/admin/reset', 'Backend\AdminController@resetPassword');
Route::post('/admin/admin/reset/default', 'Backend\AdminController@resetDefaultPassword');
Route::post('/admin/admin/delete', 'Backend\AdminController@deleteAdmin');


/**
 * User
 */
Route::post('/admin/normal/list', 'Backend\AdminController@getNormalList');
Route::get('/admin/normal/add', 'Backend\AdminController@createNormalUser');
Route::post('/admin/normal/search/{keyword}', 'Backend\AdminController@searchUsers');
Route::get('/admin/normal/get/{guid}', 'Backend\AdminController@getNormalUser');
Route::post('/admin/normal/update/{guid}', 'Backend\AdminController@updateNormalUser');
Route::post('/admin/address/create', 'Backend\AdminController@createAddress');
Route::post('/admin/address/update/{guid}', 'Backend\AdminController@updateAddress');


/**
 * Post
 */
Route::get('/admin/post/get', 'Backend\PostController@index');
Route::get('/admin/post/get/{guid}', 'Backend\PostController@getPost');
Route::get('/admin/post/get/category/{category}', 'Backend\PostController@getCategory');
Route::post('/admin/post/add', 'Backend\PostController@store');
Route::post('/admin/post/edit/{guid}', 'Backend\PostController@update');
Route::post('/admin/post/delete', 'Backend\PostController@deletePosts');
Route::post('/admin/post/update/{guid}', 'Backend\PostController@updatePublishStatus');
Route::get('/admin/post/checkPathExist/{customPath}', 'Backend\PostController@checkPathExist');


/**
 * Product
 */
Route::post('/admin/product/add', 'Backend\ProductController@store');
Route::get('/admin/product/get', 'Backend\ProductController@index');
Route::get('/admin/product/get/{guid}', 'Backend\ProductController@getProduct');
Route::post('/admin/product/edit/{guid}', 'Backend\ProductController@update');
Route::get('/admin/product/get/category/{category}', 'Backend\ProductController@getCategory');
Route::post('/admin/product/delete', 'Backend\ProductController@deleteProducts');
Route::post('/admin/product/publish', 'Backend\ProductController@publishProducts');
Route::post('/admin/product/update/{guid}', 'Backend\ProductController@updatePublishStatus');
Route::get('/admin/product/checkPathExist/{customPath}', 'Backend\ProductController@checkPathExist');
Route::get('/admin/product/search/{keyword}', 'Backend\ProductController@searchProducts');
Route::get('/admin/product/getFeature', 'Backend\ProductController@getFeatureProducts');
Route::get('/admin/product/sub/get/{guid}', 'Backend\ProductController@getSubProduct');
Route::post('/admin/product/sub/update/{guid}', 'Backend\ProductController@updateSubProduct');
Route::post('/admin/product/sub/delete/{guid}', 'Backend\ProductController@deleteSubProduct');
Route::post('/admin/product/sub/add', 'Backend\ProductController@createSubProduct');
Route::post('/admin/feature/create', 'Backend\ProductController@createFeature');
Route::post('/admin/feature/update', 'Backend\ProductController@updateFeature');
Route::get('/admin/product/low_qty', 'Backend\ProductController@getSimpleLowQty');
Route::get('/admin/product/sub/low_qty', 'Backend\ProductController@getSubLowQty');

/**
 * Page
 */
Route::post('/admin/page/add', 'Backend\PageController@createPage');
Route::get('/admin/page/get', 'Backend\PageController@getPages');
Route::get('/admin/page/get/{guid}', 'Backend\PageController@getPage');
Route::post('/admin/page/update/{guid}', 'Backend\PageController@updatePage');

/**
 * Category
 */
Route::post('/admin/category/move', 'Backend\CategoryController@move');
Route::post('/admin/category/order', 'Backend\CategoryController@order');

/**
 * Business
 */
Route::get('/admin/business/bonus/get', 'Backend\BonusController@index');
Route::post('/admin/business/bonus/add', 'Backend\BonusController@store');
Route::post('/admin/business/bonus/update', 'Backend\BonusController@updatePara');
Route::get('/admin/business/coupon/exist/{serialNumber}', 'Backend\CouponController@exist');
Route::get('/admin/business/coupon/get/{guid}', 'Backend\CouponController@get');
Route::get('/admin/business/coupon/get', 'Backend\CouponController@index');
Route::post('/admin/business/coupon/add', 'Backend\CouponController@store');
Route::post('/admin/business/coupon/update/{guid}', 'Backend\CouponController@update');
Route::post('/admin/business/coupon/delete', 'Backend\CouponController@deleteCoupons');


/**
 * Pages
 */
Route::middleware('auth')->get('/admin/page/meta/get', 'Backend\MetaController@getMeta');
Route::middleware('auth')->post('/admin/page/meta/set', 'Backend\MetaController@setMeta');
Route::middleware('auth')->post('/admin/page/meta/edit', 'Backend\MetaController@editMeta');


/**
 * Category
 */
Route::post('/admin/category/add', 'Backend\CategoryController@store');
Route::post('/admin/category/get', 'Backend\CategoryController@getCategory');
Route::post('/admin/category/delete', 'Backend\CategoryController@deleteCategory');
Route::post('/admin/category/update', 'Backend\CategoryController@updateCategory');

/**
 * Analytics
 */
Route::get('/admin/analytics/get/pageViews/{days}', 'Backend\AnalyticsController@getPageViews');
Route::get('/admin/analytics/get/getUserType/{days}', 'Backend\AnalyticsController@getUserType');

/**
 * Meta
 */
Route::get('/admin/notice/get', 'Backend\MetaController@getNotice');
Route::post('/admin/notice/create', 'Backend\MetaController@createNotice');
Route::post('/admin/notice/update', 'Backend\MetaController@updateNotice');
Route::get('/admin/privacy/get', 'Backend\MetaController@getPrivacy');
Route::post('/admin/privacy/create', 'Backend\MetaController@createPrivacy');
Route::post('/admin/privacy/update', 'Backend\MetaController@updatePrivacy');
Route::get('/admin/remind/get', 'Backend\MetaController@getRemind');
Route::post('/admin/remind/create', 'Backend\MetaController@createRemind');
Route::post('/admin/remind/update', 'Backend\MetaController@updateRemind');
Route::get('/admin/other/get', 'Backend\MetaController@getOther');
Route::post('/admin/other/create', 'Backend\MetaController@createOther');
Route::post('/admin/other/update', 'Backend\MetaController@updateOther');