<?php

namespace App\Services;

use App\Category;
use App\Product;

class Helper
{
    public static function thumb($path)
    {
        $pieces = explode('/', $path);
        $thumbPath = '';

        for ($i=0; $i < count($pieces) ; $i++) {
            if ($i == 0) {
                $thumbPath = $pieces[$i];
            } elseif ($i == (count($pieces) - 1)) {
                $thumbPath = $thumbPath.'/thumbs/'.$pieces[$i];
            } else {
                $thumbPath = $thumbPath.'/'.$pieces[$i];
            }

        }

        return $thumbPath;
    }
    
    public static function getCount($guid)
    {
        $child = Category::where('parentId', $guid)->get();
        $childCount = 0;

        foreach ($child as $key => $value) {
            $childCount += Product::where('productCategory', $value['categoryGuid'])->count();
        }
        return $childCount;
    }
}
