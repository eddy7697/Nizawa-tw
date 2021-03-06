<?php

namespace App\Services;

use App\Post;
use App;

class PostView
{
    static function allasc($int)
    {
        if (!$int) {
            $int = 15;
        }
        return Post::where('isPublish', '1')
                    ->orderBy('id', 'desc')
                    ->where('locale', App::getLocale())
                    ->paginate($int);
    }

    static function all($int)
    {
        if (!$int) {
            $int = 15;
        }
        return Post::where('isPublish', '1')
                    ->orderBy('id', 'desc')
                    ->paginate($int);
    }

    public static function get($guid)
    {
        return Post::where('guid', $guid)->first();
    }

    public static function getById($id)
    {
        return Post::where('id', $id)->first();
    }

    public static function getByPath($path)
    {
        return Post::where('customPath', $path)->first();
    }

    public static function getNewestPosts($int)
    {
        if (!$int) {
            $int = 4;
        }
        return Post::take($int)->orderBy('id', 'desc')->where('isPublish', '1')->get();
    }

    public static function getPopularProducts()
    {
        return Product::inRandomOrder()->orderBy('schedulePost', 'desc')->where('isPublish', 1)->take(4)->get();
    }

    public static function getByCategory($category, $int)
    {
        if (!$int) {
            $int = 15;
        }

        return Post::where('isPublish', '1')
                    ->orderBy('id', 'desc')
                    ->where('locale', App::getLocale())
                    ->where('postCategory', $category)->paginate($int);
    }

    public static function previous($id)
    {
        try {
            $postId = Post::where('isPublish', 1)->where('id', '<', $id)->max('id');
            return Post::where('id', $postId)->first();
        } catch (\Throwable $th) {
            return null;
        }
    }

    public static function next($id)
    {
        try {
            $postId = Post::where('isPublish', 1)->where('id', '>', $id)->min('id');
            return Post::where('id', $postId)->first();
        } catch (\Throwable $th) {
            return null;
        }
    }
}
