<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Category;
use Auth;
use Log;

class PostController extends Controller
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

        if (Auth::user()->role == 'ADMIN') {
            // return $posts = DB::table('posts')->paginate(15);
            return DB::table('posts')
                     ->orderBy($flag, $order)
                     ->leftJoin('categories', 'posts.postCategory', '=', 'categories.categoryGuid')
                     ->select('posts.*', 'categories.categoryTitle')
                     ->paginate(15);
        }
    }

    Public function getCategory(Request $request, $category)
    {
        $flag = $request->all()['flag'];
        $order = $request->all()['order'];
        $data = Post::paginate(15);
        // $postData = array();

        if (Auth::user()->role == 'ADMIN') {

            $posts = DB::table('posts')
                          ->where('postCategory', $category)
                          ->orderBy($flag, $order)
                          ->leftJoin('categories', 'posts.postCategory', '=', 'categories.categoryGuid')
                          ->select('posts.*', 'categories.categoryTitle')
                          ->paginate(15);

            $status = 200;
            $message = 'Get post information success.';
        } else {
            $status = 425;
            $message = 'Permission denied.';
            $data = null;
        }
        return $posts;
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
        $postGuid = str_random(6);

        try {
            $posts = array();

            foreach ($data as $key => $value) {
                $value['postGuid'] = $postGuid;
                
                try {
                    $post = Post::create($value);
                } catch (\Throwable $th) {
                    $post = null;
                }
                
                array_push($posts, $post);
            }

            return response()->json([ 'status' => 200, 'data' => $posts, 'message' => 'create product success' ], 200);
        } catch (\Throwable $th) {
            return response()->json([ 'status' => 500, 'data' => null, 'message' => $th->getMessage() ], 500);
        }

        // return $data;
        if (Auth::user()->role == 'ADMIN') {

            if ($data['postCategory'] == 'null') {
                $category = null;
            } else {
                $category = $data['postCategory'];
            }

            if ($data['schedulePost'] == null) {
                $schedulePost = '1900-01-01 00:00:01';
            } else {
                $schedulePost = $data['schedulePost'];
            }

            if ($data['scheduleDelete'] == null) {
                $scheduleDelete = '3000-12-31 23:59:59';
            } else {
                $scheduleDelete = $data['scheduleDelete'];
            }

            switch ($data['isPublish']) {
                case 'true':
                    $isPublish = 1;
                    break;
                case 'false':
                    $isPublish = 0;
                    break;
            }

            $createPost = Post::create([
                'postGuid' => str_random(6),
                'author' => $creatorGuid,
                'authorName' => $creator,
                'postTitle' => $data['postTitle'],
                'postCategory' => $category,
                'content' => $data['content'],
                'featureImage' => $data['featureImage'],
                'seoTitle' => $data['seoTitle'],
                'customPath' => str_random(6),
                'seoKeyword' => $data['seoKeyword'],
                'banner' => $data['banner'],
                'socialImage' => $data['socialImage'],
                'seoDescription' => $data['seoDescription'],
                'isPublish' => $isPublish,
                'schedulePost'=> $schedulePost,
                'scheduleDelete' => $scheduleDelete
            ]);

            if ($createPost) {
                $status = 200;
                $message = 'Create post success.';
            } else {
                $status = 423;
                $message = 'Create post fail.';
            }
        } else {
            $status = 425;
            $message = 'Permission denied.';
        }

        // Post::all()->searchable();

        return response()->json([ 'status' => $status, 'message' => $message ], $status);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function getPost($guid)
    {
        $localtArr = array('zh-TW', 'zh-CN', 'en');
        $result = array();

        foreach ($localtArr as $key => $value) {
            $result[$value] = Post::where('postGuid', $guid)->where('locale', $value)->first();
        }

        return $result;
        return Post::where('postGuid', $guid)->get();
    }

    /**
     * checkPrivatePath
     */
    public function checkPrivatePath($path)
    {
        // return '123';
        if (Post::where('privatePath', $path)->exists()) {
            abort(431);
            return 'exist';
        } else {
            return 'allow';
        }
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
        $postRow = Post::where('postGuid', $guid);

        $localtArr = array('zh-TW', 'zh-CN', 'en');

        // return $data;
        

        try {
            foreach ($localtArr as $key => $value) {
                if (Post::where('postGuid', $guid)->where('locale', $value)->exists()) {
                    Post::where('postGuid', $guid)->where('locale', $value)->update($data[$value]);
                } else {
                    $data[$value]['postGuid'] = $guid;
                    $data[$value]['locale'] = $value;

                    try {
                        $post = Post::create($data[$value]);
                    } catch (\Throwable $th) {
                        $post = null;
                        Log::info($th->getMessage());
                    }
                }
            }

            return response()->json([ 'status' => 200, 'data' => '$updateProduct', 'message' => 'create product success' ], 200);
        } catch (\Throwable $th) {
            return response()->json([ 'status' => 500, 'data' => null, 'message' => $th->getMessage() ], 500);
        }

        // return $data;
        if (Auth::user()->role == 'ADMIN') {

            if ($data['postCategory'] == 'null') {
                $category = null;
            } else {
                $category = $data['postCategory'];
            }

            switch ($data['isPublish']) {
                case 'true':
                    $isPublish = 1;
                    break;
                case 'false':
                    $isPublish = 0;
                    break;
            }

            $updatePost = $postRow->update([
                'postTitle' => $data['postTitle'],
                'postCategory' => $category,
                'content' => $data['content'],
                'featureImage' => $data['featureImage'],
                'seoTitle' => $data['seoTitle'],
                'seoKeyword' => $data['seoKeyword'],
                'banner' => $data['banner'],
                'customPath' => $data['customPath'],
                'socialImage' => $data['socialImage'],
                'seoDescription' => $data['seoDescription'],
                'isPublish' => $isPublish,
                'schedulePost'=> $data['schedulePost'],
                'scheduleDelete' => $data['scheduleDelete']
            ]);

            if ($updatePost) {
                $status = 200;
                $message = 'Update post success.';
            } else {
                $status = 423;
                $message = 'Update post fail.';
            }
        } else {
            $status = 425;
            $message = 'Permission denied.';
        }

        // Post::all()->searchable();

        return response()->json([ 'status' => $status, 'message' => $message ], $status);
    }

    /**
     * 確認自訂路徑是否已存在
     */
    public function checkPathExist($customPath)
    {
        $post = Post::where('customPath', $customPath)->get();

        if (count($post) > 0) {
            $status = 431;
            $message = 'customPath is exist';
        } else {
            $status = 200;
            $message = 'Add or edit is posible';
        }

        return response()->json([ 'status' => $status, 'message' => $message ], $status);
    }

    public function deletePosts(Request $request)
    {
        $data = $request->all()['data'];

        for ($i=0; $i < count($data); $i++) {
            Post::where('postGuid', $data[$i])->delete();
        }

        // Post::all()->searchable();

        return response()->json([ 'status' => 200, 'message' => '最新消息刪除成功' ], 200);
    }

    /**
     * 更新發布狀態
     */
    public function updatePublishStatus($guid, Request $request)
    {
        $data = $request->all();

        try {
            return Post::where('postGuid', $guid)->update([
                'isPublish' => $data['isPublish'],
            ]);

            $status = 200;
            $message = 'Update status success.';
        } catch (\Exception $e) {
            $status = 500;
            $message = $e->getMessage();

        }

        return response()->json([ 'status' => $status, 'message' => $message ], $status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
