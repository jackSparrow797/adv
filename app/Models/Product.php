<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'print_model_id', 'phone_type_id'
    ];

    public function printModel()
    {
        return $this->belongsTo('App\Models\PrintModel');
    }

    public function phoneType()
    {
        return $this->belongsTo('App\Models\PhoneType');
    }

}
