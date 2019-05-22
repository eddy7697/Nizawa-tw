<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SiteMeta;
use App\Product;
use App\Career;
use App\Partner;
use App\Category;
use App;

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

    public function getCategory(Request $request)
    {
        $data = $request->all();

        return Category::where('type', $data['type'])->get();
    }

    public function getPartners(Request $request)
    {
        $data = $request->all();

        return Partner::where(function ($q) use ($request)
                        {
                            if (isset($request->partnerType)) {
                                if ($request->partnerType !== null) {
                                    $q->where('partnerType', $request->partnerType);
                                }
                            }

                            if (isset($request->partnerLocation)) {
                                if ($request->partnerLocation !== null) {
                                    $q->where('partnerLocation', $request->partnerLocation);
                                }
                            }

                            $q->where('locale', App::getLocale());
                        })->get();
    }

    public function productDetail()
    {
        return view('frontend.product.productDetail', [
            'thumb' => '<a href="/">首頁</a>&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;<a href="/product">系列商品</a>'
        ]);
    }

    public function productAll()
    {
        $productAll = Product::paginate(15);

        return view('frontend.product.productAll', [
            'productAll' => $productAll,
            'mode' => 'all',
            'thumb' => '<a href="/">首頁</a>&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;系列商品'
        ]);
    }
    
    public function productMain($guid)
    {
        $productAll = Product::paginate(15);

        return view('frontend.product.productAll', [
            'productAll' => $productAll,
            'guid' => $guid,
            'mode' => 'main',
            'thumb' => '<a href="/">首頁</a>&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;系列商品'
        ]);
    }

    public function productSub($guid)
    {
        $productAll = Product::paginate(15);

        return view('frontend.product.productAll', [
            'productAll' => $productAll,
            'guid' => $guid,
            'mode' => 'sub',
            'thumb' => '<a href="/">首頁</a>&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;系列商品'
        ]);
    }

    public function productLabel()
    {
        return view('frontend.product.productLabel');
    }

    public function productLabelList($guid)
    {
        return view('frontend.product.productLabelList', [
            'guid' => $guid,
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
            'thumb' => '<a href="/">首頁</a>&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;品牌故事'
        ]);
    }
    
    public function privacy()
    {
        return view('frontend.privacy.privacy', [
            'thumb' => '<a href="/">首頁</a>&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;隱私權政策'
        ]);
    }

    public function responsibility()
    {
        return view('frontend.about.responsibility', [
            'thumb' => '<a href="/">首頁</a>&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;隱私權政策'
        ]);
    }

    public function remind()
    {
        return view('frontend.privacy.remind', [
            'thumb' => '<a href="/">首頁</a>&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;安心購物宣言'
        ]);
    }

    public function career()
    {
        return view('frontend.about.career', [
            'thumb' => '<a href="/">首頁</a>&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;安心購物宣言'
        ]);
    }

    public function notice()
    {
        return view('frontend.privacy.notice');
    }

    public function store()
    {
        return view('frontend.about.store');
    }

    public function contact()
    {
        return view('frontend.contact.contact');
    }

    public function partners()
    {
        return view('frontend.partners.index');
    }

    public function qna()
    {
        return view('frontend.qna.qna');
    }

    public function qnaSearch()
    {
        return view('frontend.qna.qnaSearch');
    }

    public function job($id)
    {
        return view('frontend.about.resume', [
            'job' => Career::where('id', $id)->first()
        ]);
    }

    public function download()
    {
        return view('frontend.about.download');
    }

    public function service()
    {
        return view('frontend.about.service');
    }

    public function industry()
    {
        return view('frontend.industry.index');
    }

    public function water()
    {
        return view('frontend.industry.water');
    }

    public function life()
    {
        return view('frontend.industry.life');
    }

    public function industrial()
    {
        return view('frontend.industry.industrial');
    }

    public function electronics()
    {
        return view('frontend.industry.electronics');
    }

    public function fishery()
    {
        return view('frontend.industry.fishery');
    }

    public function food()
    {
        return view('frontend.industry.food');
    }

    public function cosmeceutical()
    {
        return view('frontend.industry.cosmeceutical');
    }

    public function industrialEngineering()
    {
        return view('frontend.industry.industrialEngineering');
    }
}
