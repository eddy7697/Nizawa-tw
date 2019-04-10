<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubProduct extends Model
{
    protected $table = 'sub_products';

    protected $fillable = [
        'productParent',
        'subSerialNumber',
        'subProductGuid',
        'subTitle',
        'subQuantity',
        'subPrice',
        'subDiscountPrice',
        'subDescription'
    ];
}
