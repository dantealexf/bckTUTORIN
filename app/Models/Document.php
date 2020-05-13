<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'url','type','verified'
    ];

    public function profiles()
    {
        return $this->morphedByMany(Profile::class, 'profileable');
    }
}
