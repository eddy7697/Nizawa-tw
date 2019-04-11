<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SiteMeta;
use App\CustomField;

class MetaController extends Controller
{
    public function getMeta()
    {
        $meta = SiteMeta::all()->first();

        if ($meta) {
            $status = 200;
            $message = 'Get meta success';
        } else {
            $meta = null;
            $status = 404;
            $message = 'None setup';
        }

        return response()->json([ 'status' => $status, 'message' => $message, 'data' => $meta ], $status);
    }

    public function setMeta(Request $request)
    {
        $meta = SiteMeta::create($request->all());

        if ($meta) {
            $status = 200;
            $message = 'Set meta success';
        } else {
            $status = 425;
            $message = 'Set meta fail';
            $meta = null;
        }

        return response()->json([ 'status' => $status, 'message' => $message, 'data' => $meta ], $status);
    }

    public function editMeta(Request $request)
    {
        $meta = SiteMeta::all()->first()->update($request->all());

        if ($meta) {
            $status = 200;
            $message = 'Edit meta success';
        } else {
            $status = 425;
            $message = 'Edit meta fail';
            $meta = null;
        }

        return response()->json([ 'status' => $status, 'message' => $message, 'data' => $meta ], $status);
    }

    /**
     * 取得購物須知參數
     */
    public function getNotice()
    {
        $notice = CustomField::where('type', 'ECNOTICE')->first();

        return $notice;
    }

    /**
     * 建立購物須知
     */
    public function createNotice(Request $request)
    {
        $data = $request->all();

        try {
            $notice = CustomField::create($data);
            $status = 200;
            $message = 'create notice success.';
        } catch (\Exception $e) {
            $notice = null;
            $status = 500;
            $message = $e->getMessage();
        }

        return response()->json([ 'status' => $status, 'message' => $message, 'data' => $notice ], $status);
    }

    /**
     * 修改購物須知
     */
    public function updateNotice(Request $request)
    {
        $data = $request->all();

        try {
            $notice = CustomField::where('type', 'ECNOTICE')->update($data);
            $status = 200;
            $message = 'update notice success.';
        } catch (\Exception $e) {
            $notice = null;
            $status = 500;
            $message = $e->getMessage();
        }

        return response()->json([ 'status' => $status, 'message' => $message, 'data' => $notice ], $status);
    }

    /**
     * 取得購物須知參數
     */
    public function getPrivacy()
    {
        $notice = CustomField::where('type', 'PRIVACY')->first();

        return $notice;
    }

    /**
     * 建立購物須知
     */
    public function createPrivacy(Request $request)
    {
        $data = $request->all();

        try {
            $notice = CustomField::create($data);
            $status = 200;
            $message = 'create notice success.';
        } catch (\Exception $e) {
            $notice = null;
            $status = 500;
            $message = $e->getMessage();
        }

        return response()->json([ 'status' => $status, 'message' => $message, 'data' => $notice ], $status);
    }

    /**
     * 修改購物須知
     */
    public function updatePrivacy(Request $request)
    {
        $data = $request->all();

        try {
            $notice = CustomField::where('type', 'PRIVACY')->update($data);
            $status = 200;
            $message = 'update notice success.';
        } catch (\Exception $e) {
            $notice = null;
            $status = 500;
            $message = $e->getMessage();
        }

        return response()->json([ 'status' => $status, 'message' => $message, 'data' => $notice ], $status);
    }


    /**
     * 取得購物須知參數
     */
    public function getRemind()
    {
        $notice = CustomField::where('type', 'REMIND')->first();

        return $notice;
    }

    /**
     * 建立購物須知
     */
    public function createRemind(Request $request)
    {
        $data = $request->all();

        try {
            $notice = CustomField::create($data);
            $status = 200;
            $message = 'create notice success.';
        } catch (\Exception $e) {
            $notice = null;
            $status = 500;
            $message = $e->getMessage();
        }

        return response()->json([ 'status' => $status, 'message' => $message, 'data' => $notice ], $status);
    }

    /**
     * 修改購物須知
     */
    public function updateRemind(Request $request)
    {
        $data = $request->all();

        try {
            $notice = CustomField::where('type', 'REMIND')->update($data);
            $status = 200;
            $message = 'update notice success.';
        } catch (\Exception $e) {
            $notice = null;
            $status = 500;
            $message = $e->getMessage();
        }

        return response()->json([ 'status' => $status, 'message' => $message, 'data' => $notice ], $status);
    }

    /**
     * 取得購物須知參數
     */
    public function getOther()
    {
        $notice = CustomField::where('type', 'OTHER')->first();

        return $notice;
    }

    /**
     * 建立購物須知
     */
    public function createOther(Request $request)
    {
        $data = $request->all();

        try {
            $notice = CustomField::create($data);
            $status = 200;
            $message = 'create notice success.';
        } catch (\Exception $e) {
            $notice = null;
            $status = 500;
            $message = $e->getMessage();
        }

        return response()->json([ 'status' => $status, 'message' => $message, 'data' => $notice ], $status);
    }

    /**
     * 修改購物須知
     */
    public function updateOther(Request $request)
    {
        $data = $request->all();

        try {
            $notice = CustomField::where('type', 'OTHER')->update($data);
            $status = 200;
            $message = 'update notice success.';
        } catch (\Exception $e) {
            $notice = null;
            $status = 500;
            $message = $e->getMessage();
        }

        return response()->json([ 'status' => $status, 'message' => $message, 'data' => $notice ], $status);
    }
}
