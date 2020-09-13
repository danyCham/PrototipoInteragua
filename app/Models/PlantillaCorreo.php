<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlantillaCorreo extends Model
{
    protected $table ='TBL_PLANTILLA_CORREO';

    protected $fillable = ['ID_PLANTILLA','NOMBRE','CODIGO', 'ASUNTO','CUERPO','ESTADO'];

    protected $primaryKey = 'ID_PLANTILLA';
    
    protected $timestamps = false;

    protected $dateFormat = 'dd/mm/yyyy';
}
