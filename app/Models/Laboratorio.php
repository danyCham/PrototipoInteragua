<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laboratorio extends Model
{
    protected $table ='TBL_LABORATORIO';

    protected $fillable = ['ID_LABORATORIO','NOMBRE','DIRECCION','DETALLE', 'TELEFONO'];

    protected $primaryKey = 'ID_LABORATORIO';
    
    public $timestamps = false;

    protected $dateFormat = 'dd/mm/yyyy';
}
