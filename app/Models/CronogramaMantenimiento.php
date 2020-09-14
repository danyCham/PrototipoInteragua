<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CronogramaMantenimiento extends Model
{
    protected $table ='TBL_CRONOGRAMA_MANTENIMIENTO';

    protected $fillable = ['ID_CRONOGRAMA','ID_EQUIPO','ID_MANTENIMIENTO','DETALLE', 'FECHA'];

    protected $primaryKey = 'ID_CRONOGRAMA';
    
    public $timestamps = false;

    protected $dateFormat = 'dd/mm/yyyy';
}
