<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomField extends Model
{
    protected $table = 'custom_fields';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'locale',
        'content',
        'customField1',
        'customField2',
        'customField3',
        'customField4',
        'customField5',
        'customField6',
        'customField7',
        'customField8',
        'customField9',
        'customField10'
    ];
}
