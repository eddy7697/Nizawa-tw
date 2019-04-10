<?php

// home
Route::get('/home', 'HomeController@index')->name('home');


/*****************
    ADMIN
*****************/
Route::get('/admin', function () {
    return view('backend.administrator.adminPage', [
        'panelTitle' => '主控台'
    ]);
});

Route::get('/admin/add', function () {
    return view('backend.administrator.addAdmin', [
        'panelTitle' => '新增管理者帳號'
    ]);
});

Route::get('/admin/list', function () {
    return view('backend.administrator.adminList', [
        'panelTitle' => '管理者帳號列表'
    ]);
});

Route::get('/admin/reset', function () {
    return view('backend.administrator.resetPassword', [
        'currentUser' => Auth::user(),
        'panelTitle' => '重設管理者密碼'
    ]);
});


/*****************
    USER
*****************/
Route::get('/account/list', function () {
    return view('backend.account.accountList', [
        'panelTitle' => '會員資料列表'
    ]);
});


/*****************
    POST
*****************/
Route::get('/post/add', function () {
    return view('backend.post.addPost', [
        'panelTitle' => '新增最新消息',
        'mode' => 'add'
    ]);
});

Route::get('/post/edit/{guid}', function ($guid) {
    return view('backend.post.addPost', [
        'panelTitle' => '編輯最新消息',
        'mode' => 'edit',
        'guid' => $guid
    ]);
});

Route::get('/post/list', function () {
    return view('backend.post.postList', [
        'panelTitle' => '最新消息列表'
    ]);
});

Route::get('/post/postOrder', function () {
    return view('backend.post.postOrder', [
        'panelTitle' => '最新消息排序設定'
    ]);
});

Route::get('/post/category', function () {
    return view('backend.post.category', [
        'panelTitle' => '最新消息類別管理'
    ]);
});

Route::get('/post/categoryOrder', function () {
    return view('backend.post.categoryOrder', [
        'panelTitle' => '最新消息類別排序'
    ]);
});


/*****************
    PRODUCT
*****************/
Route::get('/product/add', function () {
    return view('backend.product.addProduct', [
        'panelTitle' => '新增商品',
        'mode' => 'add',
    ]);
});

Route::get('/product/category', function () {
    return view('backend.product.productCategory', [
        'panelTitle' => '商品類別管理'
    ]);
});

Route::get('/product/list', function () {
    return view('backend.product.productList', [
        'panelTitle' => '商品列表'
    ]);
});

Route::get('/product/edit/{guid}', function ($guid) {
    return view('backend.product.addProduct', [
        'panelTitle' => '編輯商品',
        'mode' => 'edit',
        'guid' => $guid
    ]);
});


/*****************
    BUSINESS
*****************/
Route::get('/business/bonus', function () {
    return view('backend.business.bonusSetup', [
        'panelTitle' => '購物金設定'
    ]);
});

Route::get('/business/coupon', function () {
    return view('backend.business.couponSetup', [
        'panelTitle' => '優惠券管理'
    ]);
});

Route::get('/business/addCoupon', function () {
    return view('backend.business.couponAdd', [
        'mode' => 'add',
        'panelTitle' => '新增優惠券'
    ]);
});

Route::get('/business/editCoupon/{guid}', function ($guid) {
    return view('backend.business.couponAdd', [
        'guid' => $guid,
        'mode' => 'edit',
        'panelTitle' => '新增優惠券'
    ]);
});

Route::get('/business/giftOrder', function () {
    return view('backend.business.giftOrder', [
        'panelTitle' => '新增試用包索取項目'
    ]);
});


/*****************
    PAGE
*****************/
Route::get('/page/managment', function()
{
    return view('backend.page.pageManagment', [
        'panelTitle' => '網站資訊'
    ]);
});
Route::get('/page/banner', function()
{
    return view('backend.page.bannerManagment', [
        'panelTitle' => '首頁輪播'
    ]);
});
Route::get('/page/add', function ()
{
    return view('backend.page.add', [
        'panelTitle' => '頁面列表',
        'mode' => 'add',
    ]);
});
Route::get('/page/list', function ()
{
    return view('backend.page.list', [
        'panelTitle' => '頁面列表',
        'type' => 'page'
    ]);
});
Route::get('/page/block', function ()
{
    return view('backend.page.list', [
        'panelTitle' => '區塊列表',
        'type' => 'block'
    ]);
});
Route::get('/page/edit/{guid}', function($guid)
{
    return view('backend.page.add', [
        'panelTitle' => '編輯頁面',
        'mode' => 'edit',
        'guid' => $guid
    ]);
});
Route::get('/page/builder', function ()
{
    return view('backend.page.pageBuilder');
});

/**
 * ORDER
 */
Route::get('/order/list', function()
{
    return view('backend.order.orderList', [
        'panelTitle' => '訂單管理'
    ]);
});

Route::get('/order/shipping-method', function()
{
    return view('backend.order.shippingMethod', [
        'panelTitle' => '運費管理'
    ]);
});


/**
 * MEDIA
 */
Route::get('/media/manager', function () {
    return view('backend.media.manager', [
        'panelTitle' => '媒體與檔案'
    ]);
});

/**
 * Other
 */
Route::get('/meta/notice', function ()
{
    return view('backend.meta.notice', [
        'panelTitle' => '購物須知'
    ]);
});
Route::get('/meta/privacy', function ()
{
    return view('backend.meta.privacy', [
        'panelTitle' => '隱私權政策'
    ]);
});
Route::get('/meta/remind', function ()
{
    return view('backend.meta.remind', [
        'panelTitle' => '安心購物宣言'
    ]);
});
Route::get('/meta/other', function ()
{
    return view('backend.meta.other', [
        'panelTitle' => '其他資訊管理'
    ]);
});