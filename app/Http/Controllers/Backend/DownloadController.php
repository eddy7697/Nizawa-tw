<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Download;

class DownloadController extends Controller
{
    /**
     * get qna's list
     */
    public function getDownloads(Request $request)
    {
        return Download::where('type', $request->type)->paginate(12);
    }

    /**
     * get qna
     */
    public function getDownload($id)
    {
        return Download::where('id', $id)->first();
    }

    /**
     * ad qna
     */
    public function addDownload(Request $request)
    {
        return Download::create($request->all());
    }

    /**
     * edit qna
     */
    public function editDownload(Request $request, $id)
    {
        return Download::where('id', $id)->update($request->all());
    }

    /**
     * updateStatus
     */
    public function updateStatus($id)
    {
        $qa = Download::where('id', $id)->first();
        return Download::where('id', $id)->update([
            'isTop' => $qa->isTop == 1 ? 0 : 1
        ]);
    }
}
