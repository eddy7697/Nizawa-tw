<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Category;
use Auth;

class CategoryController extends Controller
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

    // 取得所有分類
    public function index()
    {
        return Category::all();
    }

    // 依照類型取得類別列表
    public function getCategory(Request $request)
    {
        $data = $request->all();

        return Category::where('type', $data['type'])
                       ->orderBy('sortKey', 'asc')
                       ->get();
    }

    // 新增類別
    public function store(Request $request)
    {
        $data = [
            'categoryTitle' => $request->all()['name'],
            'parentId' => $request->all()['parentId'],
            'type' => $request->all()['type'],
            'categoryDescription' => $request->all()['description'],
        ];

        $validator = Validator::make($data, [
            'categoryTitle' => 'required|string|max:255',
        ])->validate();

        if ($data['parentId'] == 'null') {
            $data['parentId'] = null;
        }

        try {
            $category = Category::create([
                'categoryGuid' => str_random(6),
                'categoryTitle' => $data['categoryTitle'],
                'parentId' => $data['parentId'],
                'type' => $data['type'],
                'categoryDescription' => $data['categoryDescription'],
            ]);

            $status = 200;
            $message = 'Create category success.';
            $data = $category;
        } catch (\Exception $e) {
            return $e;
            $status = 400;
            $message = 'Create category fail.';
            $data = null;
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $status);
    }

    // 刪除類別
    public function deleteCategory(Request $request)
    {
        $categoryGuid = $request->all()['category'];

        $deleteRow = Category::where('categoryGuid', $categoryGuid)->delete();

        if ($deleteRow) {
            $status = 200;
            $message = 'Delete category success.';
        } else {
            $status = 404;
            $message = 'Category not found.';
        }

        return response()->json([ 'status' => $status, 'message' => $message ], $status);
    }

    // 更新類別
    public function updateCategory(Request $request)
    {
        $data = $request->all();

        return Category::where('categoryGuid', $data['category'])
                ->update(['categoryTitle' => $data['name']]);
    }

    /**
     * 移動類別
     */
    public function move(Request $request)
    {
        $param = $request->all();
        // return $param;

        if ($param['parent'] == 'ALL') {
            $parent = null;
        } else {
            $parent = $param['parent'];
        }

        try {
            $data = Category::where('categoryGuid', $param['category'])
                        ->update([
                            'parentId' => $parent
                        ]);
                        
            foreach($param['nodeMap'] as $key => $value) {
                Category::where('categoryGuid', $value['guid'])
                        ->update([
                            'sortKey' => $value['index']
                        ]);
            }

            $status = 200;
            $message = 'Move category success.';
        } catch (\Exception $e) {
            $data = null;
            $status = 500;
            $message = 'Move category failed';
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $status);
    }

    /**
     * 排序類別
     */
    public function order(Request $request)
    {
        $vo = $request->all()['order'];
        return;

        try {
            foreach($vo as $key => $value) {
                Category::where('categoryGuid', $value['guid'])
                        ->update([
                            'sortKey' => $value['index']
                        ]);
            }

            $status = 200;
            $data = null;
            $message = 'Reorder category success';
        } catch (\Exception $e) {
            $status = 500;
            $data = null;
            $message = 'Reorder category failed';
        }        

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $status);
    }
}
