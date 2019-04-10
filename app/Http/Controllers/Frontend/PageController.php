<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SiteMeta;
use App\Product;

class PageController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        // $meta = SiteMeta::all()->first();

        // $album = json_decode($meta->index_album);
        return view('index', [
            // 'album' => $album,
            'isThumbShow' => false,
            'thumb' => null
        ]);
    }

    public function productDetail()
    {
        return view('frontend.product.productDetail', [
            'isThumbShow' => true,
            'thumb' => '<a href="/">首頁</a>&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;<a href="/product">系列商品</a>'
        ]);
    }

    public function productAll()
    {
        $productAll = Product::paginate(15);

        return view('frontend.product.productAll', [
            'productAll' => $productAll,
            'isThumbShow' => true,
            'thumb' => '<a href="/">首頁</a>&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;系列商品'
        ]);
    }

    public function login()
    {
        return view('frontend.authentication.login', [
            'isThumbShow' => false,
            'thumb' => '<a href="/">首頁</a>&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;會員登入'
        ]);
    }

    public function register()
    {
        return view('frontend.authentication.register', [
            'isThumbShow' => false,
            'thumb' => '<a href="/">首頁</a>&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;會員註冊'
        ]);
    }

    public function about()
    {
        return view('frontend.about.index', [
            'isThumbShow' => true,
            'thumb' => '<a href="/">首頁</a>&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;品牌故事'
        ]);
    }
    
    public function privacy()
    {
        return view('frontend.privacy.privacy', [
            'isThumbShow' => true,
            'thumb' => '<a href="/">首頁</a>&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;隱私權政策'
        ]);
    }

    public function remind()
    {
        return view('frontend.privacy.remind', [
            'isThumbShow' => true,
            'thumb' => '<a href="/">首頁</a>&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;安心購物宣言'
        ]);
    }

    public function notice()
    {
        return view('frontend.privacy.notice', [
            'isThumbShow' => true,
            'thumb' => '<a href="/">首頁</a>&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;購物須知'
        ]);
    }

    public function store()
    {
        return view('frontend.about.store', [
            'isThumbShow' => true,
            'thumb' => '<a href="/">首頁</a>&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;銷售據點'
        ]);
    }

    public function contact()
    {
        return view('frontend.contact.contact', [
            'isThumbShow' => true,
            'thumb' => '<a href="/">首頁</a>&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;銷售據點'
        ]);
    }

    public function partners()
    {
        return view('frontend.partners.index', [
        ]);
    }
}
