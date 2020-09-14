<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table ='TBL_ROL';

    protected $fillable = ['ID_ROL','NOMBRE'];

    protected $primaryKey = 'ID_ROL';

}
