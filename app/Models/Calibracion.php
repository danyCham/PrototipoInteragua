<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calibracion extends Model
{
    protected $table ='TBL_CALIBRACION';

    protected $fillable = ['ID_CALIBRACION','ID_ESTADO','DETALLE','FECHA_CALIBRACION', 'FECHA_PROXIMA', 'USUARIO_REG', 'FECHA_REG', 'USUARIO_CAL', 'FECHA_CAL'];

    protected $primaryKey = 'ID_CALIBRACION';
    
    public $timestamps = false;

    protected $dateFormat = 'dd/mm/yyyy';
}
