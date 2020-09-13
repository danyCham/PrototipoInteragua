<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MantenimientoEquipo extends Model
{
    protected $table ='TBL_MANTENIMIENTO_EQUIPO';

    protected $fillable = ['ID_MANTENIMIENTO','DESCRIPCION','ID_CALIBRACION','ID_VERIFICA', 'FECHA_MANTENIMIENTO','FECHA_PROXIMA','USUARIO_REG', 'FECHA_REG', 'USUARIO_MANT', 'FECHA_MANT', 'ID_EQUIPO'];

    protected $primaryKey = 'ID_MANTENIMIENTO';
    
    protected $timestamps = false;

    protected $dateFormat = 'dd/mm/yyyy';
}
