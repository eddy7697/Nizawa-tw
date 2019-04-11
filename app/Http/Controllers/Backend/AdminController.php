<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Faker\Generator as Faker;
use App\User;
use App\Post;
use App\Address;
use Auth;
use Hash;

class AdminController extends Controller
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

    // 取得管理者帳號列表
    public function getAdminList()
    {
        if (Auth::user()->role == 'ADMIN') {
            return $users = DB::table('users')
                    ->where('role', 'ADMIN')->paginate(15);
        } else {
            return response()->json([ 'status' => 401, 'message' => 'Permission denied, you are not the administrator.' ], 401);
        }
    }

    // 取得一般使用者列表
    public function getNormalList(Request $request)
    {
        $flag = $request->all()['flag'];
        $order = $request->all()['order'];
        // $data = Product::paginate(15);
        // $productData = array();

        if (Auth::user()->role == 'ADMIN') {

            $users = DB::table('users')
                          ->where('role', 'NORMAL')
                          ->orderBy($flag, $order)
                          ->paginate(15);

            $status = 200;
            $message = 'Get user information success.';
        } else {
            $status = 425;
            $message = 'Permission denied.';
            $data = null;
        }
        return $users;
    }

    // 建立後台使用者帳號
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ])->validate();

        if (Auth::user()->role == 'ADMIN') {
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'role' => 'ADMIN',
                'level' => 'NORMAL',
                'password' => bcrypt($data['password']),
                'guid' => str_random(6)
            ]);
        } else {
            return response()->json([ 'status' => 401, 'message' => 'Permission denied, you are not the administrator.' ], 401);
        }
    }

    // 建立一般使用者帳號
    public function createNormalUser(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ])->validate();

        if (Auth::user()->role == 'ADMIN') {
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'role' => 'ADMIN',
                'level' => 'NORMAL',
                'password' => bcrypt($data['password']),
                'guid' => str_random(6)
            ]);
        } else {
            return response()->json([ 'status' => 401, 'message' => 'Permission denied, you are not the administrator.' ], 401);
        }
    }

    /** 
     * 編輯管理者
     */
    public function updateAdmin(Request $request, $guid)
    {
        $body = $request->all();

        try {
            $data = User::where('guid', $guid)->update($body);

            $status = 200;
            $message = 'Update admin success.';
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

    // 重設管理者密碼
    public function resetPassword(Request $request)
    {
        $data = $request->all();
        $oldPassword = $data['oldPassword'];
        $newPassword = $data['newPassword'];
        $confirmedPassword = $data['confirmedPassword'];
        $callback = [];

        $validator = Validator::make($data, [
            'newPassword' => 'required|string|min:6|max:32',
            'confirmedPassword' => 'required|string|min:6|max:32',
        ])->validate();

        if (Hash::check($oldPassword, Auth::user()->password)) {
            if ($newPassword == $confirmedPassword) {
                if ($newPassword != $oldPassword) {
                    DB::table('users')
                        ->where('guid', Auth::user()->guid)
                        ->update(['password' => bcrypt($newPassword)]);
                    $message = '密碼重設成功';
                    $status = 200;
                } else {
                    $message = '新密碼不可與舊密碼一致';
                    $status = 423;
                }
            } else {
                $message = '密碼不一致，請確認';
                $status = 423;
            }
        } else {
            $message = '舊密碼錯誤';
            $status = 423;
        }

        return response()->json([ 'status' => $status, 'message' => $message ], $status);
    }

    /**
     * 重設管理者密碼至預設值
     */
    public function resetDefaultPassword(Request $request)
    {
        $newPassword = array('new' => str_random(6));

        try {
            User::where('guid', $request->guid)->update([
                'password' => bcrypt($newPassword['new'])
            ]);
            $data = $newPassword['new'];
            $status = 200;
            $message = 'Password has been reset to '.$newPassword['new'];
        } catch(\Exception $e) {
            $data = null;
            $status = 200;
            $message = $e->getMessage();
        }

        return response()->json([ 
            'data' => $data,
            'status' => $status, 
            'message' => $message 
        ], $status);
    }

    /**
     * 搜尋一般使用者
     */
    public function searchUsers(Request $request, $keyword)
    {
        $flag = $request->all()['flag'];
        $order = $request->all()['order'];

        if (Auth::user()->role == 'ADMIN') {

            $users = DB::table('users')
                          ->where('role', 'NORMAL')
                          ->where('name', 'like', '%'.$keyword.'%')
                          ->orWhere('email', 'like', '%'.$keyword.'%')
                          ->orderBy($flag, $order)
                          ->paginate(15);

            $status = 200;
            $message = 'Get product information success.';
        } else {
            $status = 425;
            $message = 'Permission denied.';
            $data = null;
        }
        return $users;
    }

    /**
     * 取得一般使用者
     */
    public function getNormalUser($guid)
    {   
        $user = User::where('guid', $guid)->first();
        $user['address'] = Address::where('owner', $guid)->first();

        return $user;
    }

    // 刪除管理者
    public function deleteAdmin(Request $request)
    {
        $guid = $request->all();

        if (Auth::user()->guid == $guid['adminUser']) {
            $message = '你不可以刪除自己的帳號';
            $status = 423;
        } else {
            DB::table('users')
                ->where('guid', $guid['adminUser'])
                ->delete();
            $message = '刪除成功';
            $status = 200;
        }

        return response()->json([ 'status' => $status, 'message' => $message ], $status);
    }

    // 產生測試資料 - 一般使用者
    public function generateDumyNormalUser(Faker $faker)
    {
        for ( $i=0 ; $i<150 ; $i++ ) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'role' => 'NORMAL',
                'level' => 'NORMAL',
                'password' => bcrypt('111111'),
                'guid' => str_random(6)
            ]);
        }

        return $users = DB::table('users')
                ->where('role', 'NORMAL')
                ->get();
    }

    // 產生測試資料 - 後台使用者 (最高權限)
    public function generateDumyAdminUser()
    {
        for ( $i=0 ; $i<10 ; $i++ ) {
            User::create([
                'name' => 'dummyAdmin'.$i,
                'email' => 'dummyAdmin'.$i.'@gmail.com',
                'role' => 'ADMIN',
                'level' => 'NORMAL',
                'password' => bcrypt('111111'),
                'guid' => str_random(6)
            ]);
        }

        return $users = DB::table('users')
                ->where('role', 'ADMIN')
                ->get();
    }

    // 產生測試資料 - 最新消息
    public function generateDumyPost(Faker $faker)
    {
        $author = Auth::user()->guid;
        $authorName = Auth::user()->name;

        for ( $i=0 ; $i<120 ; $i++ ) {
            Post::create([
                'author' => $author,
                'authorName' => $authorName,
                'postGuid' => $faker->uuid(),
                'customPath' => str_random(6),
                'postTitle' => $faker->sentence(5),
                'featureImage' => 'https://picsum.photos/800/600/?image='.$faker->numberBetween(1, 500),
                'content' => $faker->randomHtml(2,3)
            ]);
        }

        return $users = DB::table('posts')
                ->where('author', $author)
                ->get();
    }

    // 更新一般使用者
    public function updateNormalUser(Request $request, $guid)
    {
        $data = $request->all();
        
        $user = User::where('guid', $guid)
                ->update([
                    'name' => $data['name'],
                    'remark' => $data['remark']
                ]);
    }

    // 建立使用者資訊
    public function createAddress(Request $request)
    {
        $data = $request->all();
        $data['guid'] = str_random(6);
        $address = Address::create($data);
        return $request->all();
    }

    // 更新使用者資訊
    public function updateAddress(Request $request, $owner)
    {
        $data = $request->all();

        $address = Address::where('owner', $owner)->update($data);
        return $address;
    }
}
