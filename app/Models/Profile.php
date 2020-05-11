<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $fillable = [
        'status_id','dni','description','valoration','message','viewed'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function location()
    {
        return $this->hasOne(Location::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function file()
    {
        return $this->morphToMany(File::class, 'fileable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
