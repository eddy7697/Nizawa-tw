<?php

namespace App\Services;

use App\Product;

class ProductView
{
    static function all()
    {
        return Product::where('isPublish', '1')
                        // ->where('quantity', '>', 0)
                        ->where(function ($query) {
                            $query->where('schedulePost', '>', time())
                                ->orwhere('schedulePost','=',null);
                        })
                        ->where(function ($query) {
                            $query->where('scheduleDelete','<',time())
                                ->orwhere('scheduleDelete','=',null);
                        })
                        ->leftJoin('categories', 'products.productCategory', '=', 'categories.categoryGuid')
                        ->select('products.*', 'categories.categoryTitle')
                        ->orderBy('schedulePost', 'desc')->paginate(12);
    }

    public static function getPopularProducts()
    {
        return Product::where('isPublish', '1')
                        // ->where('quantity', '>', 0)
                        ->where(function ($query) {
                            $query->where('schedulePost', '>', time())
                                ->orwhere('schedulePost','=',null);
                        })
                        ->where(function ($query) {
                            $query->where('scheduleDelete','<',time())
                                ->orwhere('scheduleDelete','=',null);
                        })
                        ->leftJoin('categories', 'products.productCategory', '=', 'categories.categoryGuid')
                        ->select('products.*', 'categories.categoryTitle')
                        ->inRandomOrder()->take(4)->get();
    }
    
    public static function getPopularProductsByCount($int)
    {
        return Product::where('isPublish', '1')
                        // ->where('quantity', '>', 0)
                        ->where(function ($query) {
                            $query->where('schedulePost', '>', time())
                                ->orwhere('schedulePost','=',null);
                        })
                        ->where(function ($query) {
                            $query->where('scheduleDelete','<',time())
                                ->orwhere('scheduleDelete','=',null);
                        })
                        ->leftJoin('categories', 'products.productCategory', '=', 'categories.categoryGuid')
                        ->select('products.*', 'categories.categoryTitle')
                        ->orderBy('schedulePost', 'desc')->inRandomOrder()->take($int)->get();
    }

    public static function getByCategory($category)
    {
        return Product::where('isPublish', '1')
                        // ->where('quantity', '>', 0)
                        ->where(function ($query) {
                            $query->where('schedulePost', '>', time())
                                ->orwhere('schedulePost','=',null);
                        })
                        ->where(function ($query) {
                            $query->where('scheduleDelete','<',time())
                                ->orwhere('scheduleDelete','=',null);
                        })                        
                        ->where('productCategory', $category)
                        ->leftJoin('categories', 'products.productCategory', '=', 'categories.categoryGuid')
                        ->select('products.*', 'categories.categoryTitle')
                        ->orderBy('schedulePost', 'desc')->paginate(12);
    }

    public static function takeByCategory($category)
    {
        return Product::where('isPublish', '1')
                        // ->where('quantity', '>', 0)
                        ->where(function ($query) {
                            $query->where('schedulePost', '>', time())
                                ->orwhere('schedulePost','=',null);
                        })
                        ->where(function ($query) {
                            $query->where('scheduleDelete','<',time())
                                ->orwhere('scheduleDelete','=',null);
                        })
                        ->where('productCategory', $category)
                        ->leftJoin('categories', 'products.productCategory', '=', 'categories.categoryGuid')
                        ->select('products.*', 'categories.categoryTitle')
                        ->orderBy('schedulePost', 'desc')->take(10)->get();
    }
}
