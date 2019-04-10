<?php

namespace App\Services;

use App\Category;

class CategoryView
{
    public static function get($guid)
    {               
        return Category::where('categoryGuid', $guid)->first();
    }

    public static function product()
    {
        return Category::where('type', 'product')
                       ->orderBy('sortKey', 'asc')
                       ->get();
    }

    public static function productRoot()
    {
        return Category::where('type', 'product')
                       ->orderBy('sortKey', 'asc')
                       ->whereNull('parentId')
                       ->get();
    }

    public static function getProductByParent($category)
    {
        return Category::where('parentId', $category)
                       ->orderBy('sortKey', 'asc')
                       ->get();
    }

    public static function postRoot()
    {
        return Category::where('type', 'post')
                       ->orderBy('sortKey', 'asc')
                       ->whereNull('parentId')
                       ->get();
    }

    public static function getPostByParent($category)
    {
        return Category::where('parentId', $category)
                       ->orderBy('sortKey', 'asc')
                       ->get();
    }

    public static function post()
    {
        return Category::where('type', 'post')
                       ->orderBy('id', 'asc')
                       ->get();
    }
}
