<?php

namespace App\Services;

use App\Page;

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
}
