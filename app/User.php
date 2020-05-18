<?php

namespace App;

use App\Models\Advisory;
use App\Models\Comment;
use App\Models\Course;
use App\Models\Image;
use App\Models\Level;
use App\Models\Location;
use App\Models\Offer;
use App\Models\Profile;
use App\Models\Task;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','email_verified_at','remember_token', 'password','birthday','gender','mobile','active','admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = ['birthday'];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function setBirthdayAttribute($birthday)
    {
        $this->attributes['birthday'] = Carbon::parse($birthday);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function location()
    {
        return $this->hasOneThrough(Location::class, Profile::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function advisory()
    {
        return $this->hasMany(Advisory::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function offers()
    {
        return $this->morphMany(Offer::class, 'offersable');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
