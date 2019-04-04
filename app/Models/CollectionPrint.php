<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollectionPrint extends Model
{
    protected $fillable = [
        'title'
    ];

    public function printModels()
    {
        return $this->belongsToMany('App\Models\PrintModel');
    }
}
