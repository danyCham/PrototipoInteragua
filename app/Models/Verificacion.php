<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Verificacion extends Model
{
    protected $table ='TBL_VERIFICA';

    protected $fillable = ['ID_VERIFICA','ID_ESTADO', 'DETALLE','FECHA_VERIFICA','FECHA_PROXIMA','USUARIO_REG','FECHA_REG','USUARIO_VER','FECHA_VER'];

    protected $primaryKey = 'ID_VERIFICA';
    
    protected $timestamps = false;

    protected $dateFormat = 'dd/mm/yyyy';
}
