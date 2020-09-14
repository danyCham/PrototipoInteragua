<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $table ='TBL_EQUIPO';

    protected $fillable = ['ID_EQUIPO','NOMBRE','DETALLE','MARCA', 'MODELO', 'ID_LABORATORIO', 'USUARIO_CREA', 'FECHA_CREA'];

    protected $primaryKey = 'ID_EQUIPO';
    
    public $timestamps = false;

    protected $dateFormat = 'dd/mm/yyyy';
}
