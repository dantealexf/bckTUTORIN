<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $guarded = [];

    /*
     * CC => CEDULA DE CIUDADANIA
     * CE => CEDULA DE EXTRANJERIA
     * PA => PASAPORTE
     * TI => TARJETA DE IDENTIDAD
     * ES => ESTUDIO
     * CB => CERTIFICACION BANCARIA
     * DC => DOCUMENTO
     */

    protected $fillable = [
        'user_id','url','type','verified',''
    ];

    public function fileable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class); //user_id
    }

}
