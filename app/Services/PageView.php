<?php

namespace App\Services;

use App\Page;
use App\Qna;
use App\Download;
use App\CustomField;
use Log;

class PageView
{
    public static function show($id)
    {
        $page = Page::where('id', $id)->first();

        $content = json_decode($page['content']);
        return $content->content;
    }

    public static function title($id)
    {
        return Page::where('id', $id)->first()['title'];
    }

    static function getTagByType($type)
    {
        return CustomField::where('type', $type.'_tag')->get();
    }

    static function qna($type)
    {
        return Qna::where('qatype', $type)->get();
    }

    static function download($type)
    {
        return Download::where('type', $type)->get();
    }
    
    static function downloadAll()
    {
        return Download::all();
    }

    static function qnaTop()
    {
        return Qna::where('isTop', 1)->get();
    }

    static function qnaCount($keyword)
    {
        return Qna::orWhere('qatitle', 'like', '%'.$keyword.'%')->orWhere('qacontent', 'like', '%'.$keyword.'%')->count();
    }

    static function qnaSearch($keyword, $type = "")
    {
        return Qna::where(function ($q) use ($keyword)
                    {
                        $q->where('qatitle', 'like', '%'.$keyword.'%');
                    })
                    ->get();
    }
    
    public static function industry($id)
    {
        $content = CustomField::where('id', (int)$id)->first();
        return json_decode($content->content);
    }
}
