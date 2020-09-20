<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParametrosGenerales extends Model
{
    protected $table ='TBL_PARAMETROS_GENERALES';

    protected $fillable = ['ID_PARAMETRO','KEY','VALUE', 'TIPO_VARIABLE','DESCRIPCION','USUARIO_CREA','FECHA_CREA','USUARIO_MOD','FECHA_MOD','USUARIO_ELIM','FECHA_ELIM'];

    protected $primaryKey = 'ID_PARAMETRO';
    
    public $timestamps = false;

    protected $dateFormat = 'dd/mm/yyyy';
}
