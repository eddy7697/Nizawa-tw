<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use App\CustomField;
use App\SubProduct;
use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $flag = $request->all()['flag'];
        $order = $request->all()['order'];
        $qty = $request->qty;
        $type = $request->productType;

        if (Auth::user()->role == 'ADMIN') {

            $products = DB::table('products')
                            ->where(function ($query) use ($qty, $type)
                            {
                                if ($type == 'simple') {
                                    $query->where('productType', 'simple');

                                    if ($qty == 'ot') {
                                        $query->where('quantity', '<', 1);
                                    } elseif ($qty == 'lowq') {
                                        $query->where('quantity', '<', 10);
                                    }
                                } elseif ($type == 'all') {
                                    if ($qty == 'ot') {
                                        $query->where('quantity', '<', 1);
                                    } elseif ($qty == 'lowq') {
                                        $query->where('quantity', '<', 10);
                                    }
                                } elseif ($type == 'variable') {
                                    $query->where('productType', 'variable');
                                }
                            })
                            ->leftJoin('categories', 'products.productCategory', '=', 'categories.categoryGuid')
                            ->select('products.*', 'categories.categoryTitle')
                            ->orderBy($flag, $order)
                            ->paginate(15);

            foreach ($products as $key => $value) {
                if ($value->productType == 'variable') {
                    $value->subProduct = SubProduct::where('productParent', $value->productGuid)->get();
                }
            }

            $status = 200;
            $message = 'Get product information success.';
        } else {
            $status = 425;
            $message = 'Permission denied.';
            $data = null;
        }
        return $products;
    }

    /**
     * 搜尋產品
     */
    public function searchProducts(Request $request, $keyword)
    {
        $flag = $request->all()['flag'];
        $order = $request->all()['order'];
        $qty = $request->qty;
        $type = $request->productType;

        if (Auth::user()->role == 'ADMIN') {

            $products = DB::table('products')
                            ->where('productTitle', 'like', '%'.$keyword.'%')
                            ->where(function ($query) use ($qty, $type)
                            {
                                if ($type == 'simple') {
                                    $query->where('productType', 'simple');

                                    if ($qty == 'ot') {
                                        $query->where('quantity', '<', 1);
                                    } elseif ($qty == 'lowq') {
                                        $query->where('quantity', '<', 10);
                                    }
                                } elseif ($type == 'all') {
                                    if ($qty == 'ot') {
                                        $query->where('quantity', '<', 1);
                                    } elseif ($qty == 'lowq') {
                                        $query->where('quantity', '<', 10);
                                    }
                                } elseif ($type == 'variable') {
                                    $query->where('productType', 'variable');
                                }
                            })
                            ->leftJoin('categories', 'products.productCategory', '=', 'categories.categoryGuid')
                            ->select('products.*', 'categories.categoryTitle')
                            ->orderBy($flag, $order)
                            ->paginate(15);

            foreach ($products as $key => $value) {
                if ($value->productType == 'variable') {
                    $value->subProduct = SubProduct::where('productParent', $value->productGuid)->get();
                }
            }

            $status = 200;
            $message = 'Get product information success.';
        } else {
            $status = 425;
            $message = 'Permission denied.';
            $data = null;
        }
        return $products;
    }

    /**
     * 取得指定類別的產品列表
     */
    Public function getCategory(Request $request, $category)
    {
        $flag = $request->all()['flag'];
        $order = $request->all()['order'];
        $qty = $request->qty;
        $type = $request->productType;

        if (Auth::user()->role == 'ADMIN') {

            $products = DB::table('products')
                            ->where('productCategory', $category)
                            ->where(function ($query) use ($qty, $type)
                            {
                                if ($type == 'simple') {
                                    $query->where('productType', 'simple');

                                    if ($qty == 'ot') {
                                        $query->where('quantity', '<', 1);
                                    } elseif ($qty == 'lowq') {
                                        $query->where('quantity', '<', 10);
                                    }
                                } elseif ($type == 'all') {
                                    if ($qty == 'ot') {
                                        $query->where('quantity', '<', 1);
                                    } elseif ($qty == 'lowq') {
                                        $query->where('quantity', '<', 10);
                                    }
                                } elseif ($type == 'variable') {
                                    $query->where('productType', 'variable');
                                }
                            })                            
                            ->leftJoin('categories', 'products.productCategory', '=', 'categories.categoryGuid')
                            ->select('products.*', 'categories.categoryTitle')
                            ->orderBy($flag, $order)
                            ->paginate(15);

            foreach ($products as $key => $value) {
                if ($value->productType == 'variable') {
                    $value->subProduct = SubProduct::where('productParent', $value->productGuid)->get();
                }
            }

            $status = 200;
            $message = 'Get product information success.';
        } else {
            $status = 425;
            $message = 'Permission denied.';
            $data = null;
        }
        return $products;
    }

    public function getProduct($guid)
    {
        $localtArr = array('zh-TW', 'zh-CN', 'en');
        $result = array();

        foreach ($localtArr as $key => $value) {
            $result[$value] = Product::where('productGuid', $guid)->where('locale', $value)->first();
        }

        return $result;
    }

    /**
     * 取得子商品
     */
    public function getSubProduct($guid)
    {
        return response()->json([ 
            'status' => 200, 
            'data' => SubProduct::where('productParent', $guid)->get(), 
            'message' => 'Get subproduct success'
        ], 200);
    }

    /** 
     * 新增子商品
     */
    public function createSubProduct(Request $request)
    {
        $body = $request->all();

        try {
            $body['subProductGuid'] = str_random(6);

            $data = SubProduct::create($body);
            $status = 200;
            $message = 'Create subproduct success';
        } catch(\Exception $e) {
            $data = null;
            $status = 500;
            $message = $e->getMessage();
        }

        return response()->json([ 
            'status' => $status, 
            'data' => $data, 
            'message' => $message 
        ], $status);
    }

    /** 
     * 修改子商品
     */
    public function updateSubProduct(Request $request, $guid)
    {
        $body = $request->all();
        
        try {
            $data = SubProduct::where('subProductGuid', $guid)->update($body);
            $status = 200;
            $message = 'Update SubProduct success';
        } catch(\Excpetion $e) {
            $status = 500;
            $data = null;
            $message = 'Update SubProduct failed';
        }

        return response()->json([ 
            'status' => $status, 
            'data' => $data, 
            'message' => $message 
        ], $status);
    }

    /** 
     * 刪除子商品
     */
    public function deleteSubProduct($guid)
    {
        try {
            $data = SubProduct::where('subProductGuid', $guid)->delete();
            $status = 200;
            $message = 'Delete SubProduct success.';
        } catch(\Exception $e) {
            $data = null;
            $status = 500;
            $message = $e->getMessage();
        }

        return response()->json([ 
            'status' => $status, 
            'data' => $data, 
            'message' => $message 
        ], $status);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $creator = Auth::user()->name;
        $creatorGuid = Auth::user()->guid;
        $productGuid = str_random(6);

        try {
            foreach ($data as $key => $value) {
                $value['productGuid'] = $productGuid;
                $value['album'] = json_encode($value['album']);
                $value['productInformation'] = json_encode($value['productInformation']);
                Product::create($value);
            }

            return response()->json([ 'status' => 200, 'data' => '$createProduct', 'message' => 'create product success' ], 200);
        } catch (\Throwable $th) {
            return response()->json([ 'status' => 500, 'data' => null, 'message' => $th->getMessage() ], 500);
        }
         

        
        // return $data;

        // return $data;
        if (Auth::user()->role == 'ADMIN') {

            if ($data['productCategory'] == 'null') {
                $category = null;
            } else {
                $category = $data['productCategory'];
            }

            switch ($data['isPublish']) {
                case 'true':
                    $isPublish = 1;
                    break;
                case 'false':
                    $isPublish = 0;
                    break;
            }

            switch ($data['reserveStatus']) {
                case 'true':
                    $reserveStatus = 1;
                    break;
                case 'false':
                    $reserveStatus = 0;
                    break;
            }

            try {
                $createProduct = Product::create([
                    'productGuid' => str_random(6),
                    'productTitle' => $data['productTitle'],
                    'serialNumber' => $data['serialNumber'],
                    'quantity' => $data['quantity'],
                    'author' => $creatorGuid,
                    'authorName' => $creator,
                    'productCategory' => $category,
                    'mainCategory' => $data['mainCategory'],
                    'subCategory' => $data['subCategory'],
                    'featureImage' => $data['featureImage'],
                    'album' => $data['album'],
                    'productStatus' => $data['productStatus'],
                    'customPath' => str_random(6),
                    'isPublish' => $isPublish,
                    'reserveStatus' => $reserveStatus,
                    'rule' => $data['rule'],
                    'price' => $data['price'],
                    'productType' => $data['productType'],
                    'Temperature' => $data['Temperature'],
                    'productInformation' => $data['productInformation'],
                    'discountedPrice' => $data['discountedPrice'],
                    'productDescription' => $data['productDescription'],
                    'seoTitle' => $data['seoTitle'],
                    'seoDescription' => $data['seoDescription'],
                    'seoKeyword' => $data['seoKeyword'],
                    'shortDescription' => $data['shortDescription'],
                    'socialImage' => $data['socialImage'],
                    'schedulePost'=> $data['schedulePost'],
                    'scheduleDelete' => $data['scheduleDelete']
                ]);

                $status = 200;
                $message = 'Create product success.';
            } catch (\Exception $e) {
                $status = 500;
                $message = $e;
            }
        } else {
            $createProduct = null;
            $status = 425;
            $message = 'Permission denied.';
        }

        // Product::all()->searchable();

        return response()->json([ 'status' => $status, 'data' => $createProduct, 'message' => $message ], $status);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $guid)
    {
        $data = $request->all();
        $postRow = Product::where('productGuid', $guid);
        $localtArr = array('zh-TW', 'zh-CN', 'en');

        // return $data;
        

        try {
            foreach ($localtArr as $key => $value) {
                $data[$value]['album'] = json_encode($data[$value]['album']);
                $data[$value]['productInformation'] = json_encode($data[$value]['productInformation']);
                Product::where('productGuid', $guid)->where('locale', $value)->update($data[$value]);
            }

            return response()->json([ 'status' => 200, 'data' => '$createProduct', 'message' => 'create product success' ], 200);
        } catch (\Throwable $th) {
            return response()->json([ 'status' => 500, 'data' => null, 'message' => $th->getMessage() ], 500);
        }

        return $data;

        // return $data;
        if (Auth::user()->role == 'ADMIN') {

            if ($data['productCategory'] == 'null') {
                $category = null;
            } else {
                $category = $data['productCategory'];
            }

            switch ($data['isPublish']) {
                case 'true':
                    $isPublish = 1;
                    break;
                case 'false':
                    $isPublish = 0;
                    break;
            }

            switch ($data['reserveStatus']) {
                case 'true':
                    $reserveStatus = 1;
                    break;
                case 'false':
                    $reserveStatus = 0;
                    break;
            }

            try {
                $updateProduct = $postRow->update([
                    'productTitle' => $data['productTitle'],
                    'serialNumber' => $data['serialNumber'],
                    'quantity' => $data['quantity'],
                    'productCategory' => $category,
                    'featureImage' => $data['featureImage'],
                    'mainCategory' => $data['mainCategory'],
                    'subCategory' => $data['subCategory'],
                    'album' => $data['album'],
                    'productStatus' => $data['productStatus'],
                    'rule' => $data['rule'],
                    'price' => $data['price'],
                    'productInformation' => $data['productInformation'],
                    'discountedPrice' => $data['discountedPrice'],
                    'productType' => $data['productType'],
                    'reserveStatus' => $reserveStatus,
                    // 'customPath' => $data['customPath'],
                    'Temperature' => $data['Temperature'],
                    'productDescription' => $data['productDescription'],
                    'seoTitle' => $data['seoTitle'],
                    'seoDescription' => $data['seoDescription'],
                    'seoKeyword' => $data['seoKeyword'],
                    'shortDescription' => $data['shortDescription'],
                    'socialImage' => $data['socialImage'],
                    'schedulePost'=> $data['schedulePost'],
                    'scheduleDelete' => $data['scheduleDelete']
                ]);

                $status = 200;
                $message = 'Update product success.';
            } catch (\Exception $e) {
                $status = 500;
                $message = $e;
            }
        } else {
            $status = 425;
            $message = 'Permission denied.';
        }

        // Product::all()->searchable();

        return response()->json([ 'status' => $status, 'message' => $message ], $status);
    }

    /**
     * 確認自訂路徑是否已存在
     */
    public function checkPathExist($customPath)
    {
        $post = Product::where('customPath', $customPath)->get();

        if (count($post) > 0) {
            $status = 431;
            $message = 'customPath is exist';
        } else {
            $status = 200;
            $message = 'Add or edit is posible';
        }

        return response()->json([ 'status' => $status, 'message' => $message ], $status);
    }

    /**
     * 刪除已選取的商品
     */
    public function deleteProducts(Request $request)
    {
        $data = $request->all()['data'];

        try {
            for ($i=0; $i < count($data); $i++) {
                Product::where('productGuid', $data[$i])->delete();
            }

            $status = 200;
            $message = 'Delete Post success.';
        } catch (\Exception $e) {
            $status = 500;
            $message = $e->getMessage();
        }

        return response()->json([ 'status' => $status, 'message' => $message ], $status);
    }

    /** 
     * 更新已選取的商品狀態
     */
    public function publishProducts(Request $request)
    {

        try {

            foreach ($request->data as $key => $value) {
                Product::where('productGuid', $value['productGuid'])->update([
                    'isPublish' => true
                ]);
            }
            $data = '';
            $status = 200;
            $message = 'Update status success.';
        } catch (\Exception $e) {
            $data = null;
            $status = 500;
            $message = $e->getMessage();

        }

        return response()->json([ 
            'status' => $status, 
            'data' => $data,
            'message' => $message 
        ], $status);
    }

    /**
     * 更新發布狀態
     */
    public function updatePublishStatus($guid, Request $request)
    {
        $body = $request->all();

        try {
            $data = Product::where('productGuid', $guid)->update([
                'isPublish' => $body['isPublish'] == 1 ? true : false,
            ]);

            $status = 200;
            $message = 'Update status success.';
        } catch (\Exception $e) {
            $data = null;
            $status = 500;
            $message = $e->getMessage();

        }

        return response()->json([ 
            'status' => $status, 
            'data' => $data,
            'message' => $message 
        ], $status);
    }

    /**
     * Get the feature products
     */
    public function getFeatureProducts()
    {
        try {
            $firstGuid = CustomField::where('type', 'feature_1')->first()['customField1'];
            $first = Product::where('productGuid', $firstGuid)->first();
        }  catch (\Exception $e) {
            $first = null;
        }

        try {
            $secondGuid = CustomField::where('type', 'feature_2')->first()['customField1'];
            $second = Product::where('productGuid', $secondGuid)->first();
        }  catch (\Exception $e) {
            $second = null;
        }

        try {
            $thirdGuid = CustomField::where('type', 'feature_3')->first()['customField1'];
            $third = Product::where('productGuid', $thirdGuid)->first();
        }  catch (\Exception $e) {
            $third = null;
        }

        try {
            $fourthGuid = CustomField::where('type', 'feature_4')->first()['customField1'];
            $fourth = Product::where('productGuid', $fourthGuid)->first();
        }  catch (\Exception $e) {
            $fourth = null;
        }
        

        $feature = array(
            'first' => $first, 
            'second' => $second,
            'third' => $third,
            'fourth' => $fourth
        );

        return response()->json([ 'status' => 200, 'data' => $feature, 'message' => 'Get feature success.' ], 200);
    }

    public function createFeature(Request $request)
    {
        $data = $request->all();

        if (CustomField::where('type', $data['type'])->exists()) {
            return CustomField::where('type', $data['type'])->update([
                'locale' => 'zh-tw',
                'customField1' => $data['guid']
            ]);
        } else {
            return CustomField::create([
                'type' => $data['type'],
                'locale' => 'zh-tw',
                'customField1' => $data['guid']
            ]);
        }

        
    }

    public function udpateFeature(Request $request)
    {
        $data = $request->all();

        return CustomField::where('type', $data['type'])->update([
            'locale' => 'zh-tw',
            'customField1' => $data['guid']
        ]);
    }

    /**
     * 取得一般商品低庫存警示
     */
    public function getSimpleLowQty()
    {
        return Product::where('quantity', '<', 3)->get();
    }

    /**
     * 取得子商品低庫存警示
     */
    public function getSubLowQty()
    {
        return SubProduct::where('subQuantity', '<', 3)
                            ->leftJoin('products', 'sub_products.productParent', '=', 'products.productGuid')
                            ->select('sub_products.*', 'products.productTitle')
                            ->get();
    }
}
