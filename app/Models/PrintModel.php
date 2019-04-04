<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrintModel extends Model
{
    protected $fillable = [
        'title'
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function CollectionPrints()
    {
        return $this->belongsToMany('App\Models\CollectionPrint');
    }

}
