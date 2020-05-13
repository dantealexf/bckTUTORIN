<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $fillable = [
        'dni','description','valoration','message','viewed','verified','request'
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

    public function documents()
    {
        return $this->morphToMany(Document::class, 'documentable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
