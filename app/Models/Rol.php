<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table ="tbl_rol";

    protected $fillable=[
        'id_rol',
        'nombre',
    ];

    protected $primaryKey = 'id_rol';

    public $timestamps = false;
}
