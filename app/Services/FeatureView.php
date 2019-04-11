<?php

namespace App\Services;

use App\CustomField;
use App\Product;

/**
 *
 */
class FeatureView
{
    function __construct()
    {

    }

    static function get($type)
    {
        try {
            $productGuid = CustomField::where('type', $type)->first()['customField1'];
            $product = Product::where('productGuid', $productGuid)->first();
        } catch (\Exception $e) {
            $product = Product::orderBy('created_at', 'desc')->inRandomOrder()->take(1)->get();
        }        

        return $product;
    }

}
