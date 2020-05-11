<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    protected $fillable = [
        'name'
    ];

    public function tasks()
    {
        return $this->morphedByMany(Task::class, 'taggable');
    }

    public function profiles()
    {
        return $this->morphedByMany(Profile::class, 'profileable');
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
