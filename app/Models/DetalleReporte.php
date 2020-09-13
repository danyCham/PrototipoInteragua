<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleReporte extends Model
{
    protected $table ='TBL_DETALLE_REPORTE';

    protected $fillable = ['ID_DETALLE_REPORTE','ID_CABECERA_REPORTE','DETALLE','LOGO', 'TITULO', 'FIRMA'];

    protected $primaryKey = 'ID_DETALLE_REPORTE';
    
    protected $timestamps = false;

    protected $dateFormat = 'dd/mm/yyyy';
}
