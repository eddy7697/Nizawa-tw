<?php

namespace App;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use Searchable;

    protected $table = 'products';

    protected $fillable = [
        'id',
        'productGuid',
        'productTitle',
        'serialNumber',
        'locale',
        'mainCategory',
        'subCategory',
        'quantity',
        'author',
        'authorName',
        'productCategory',
        'featureImage',
        'album',
        'Temperature',
        'customPath',
        'productStatus',
        'rule',
        'rate',
        'command',
        'productType',
        'reserveStatus',
        'isPublish',
        'price',
        'discountedPrice',
        'productDescription',
        'shortDescription',
        'productInformation',
        'socialImage',
        'seoTitle',
        'seoKeyword',
        'seoDescription',
        'schedulePost',
        'sortKey',
        'scheduleDelete'
    ];

    /**
     * get index
     */
    public function searchableAs()
    {
        return 'products_index';
    }

    /**
     * show
     */
    public static function show()
    {
        return Product::where('isPublish', 1)->where('locale', App::getLocale());
    }
}
