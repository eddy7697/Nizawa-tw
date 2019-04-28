<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Qna;

class QnaController extends Controller
{
    /**
     * get qna's list
     */
    public function getQnas(Request $request)
    {
        return Qna::where('qatype', $request->type)->paginate(12);
    }

    /**
     * get qna
     */
    public function getQna($id)
    {
        return Qna::where('id', $id)->first();
    }

    /**
     * ad qna
     */
    public function addQna(Request $request)
    {
        return Qna::create($request->all());
    }

    /**
     * edit qna
     */
    public function editQna(Request $request, $id)
    {
        return Qna::where('id', $id)->update($request->all());
    }
}
