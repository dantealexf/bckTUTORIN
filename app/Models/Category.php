<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $guarded = [];


    public function taks()
    {
        return $this->hasMany(Task::class);
    }

    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }

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
