<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Level extends Model
{
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'url';
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['url'] = Str::slug($name,'_');
    }
}
