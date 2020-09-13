<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CabeceraReporte extends Model
{
    protected $table ='TBL_CABECERA_REPORTE';

    protected $fillable = ['ID_CABECERA_REPORTE','TITULO','DESCRIPCION','ESTADO'];

    protected $primaryKey = 'ID_CABECERA_REPORTE';
    
    protected $timestamps = false;
}
