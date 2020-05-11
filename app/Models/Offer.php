<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'user_id','task_id','advisory_id','body'
    ];

    public function offersable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
