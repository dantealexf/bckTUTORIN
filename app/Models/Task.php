<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Task extends Model
{

    protected $fillable = [
        'user_id', 'category_id','level_id','title', 'url','delivery','price','excerpt','body'
    ];

    protected $dates = ['delivery'];


    public function setNameAttribute($title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['url'] = Str::slug($title,'_');
    }

    public function setDeliveryAttribute($delivery)
    {
        $this->attributes['delivery'] = Carbon::parse($delivery);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function offers()
    {
        return $this->morphMany(Offer::class, 'offersable');
    }

}
