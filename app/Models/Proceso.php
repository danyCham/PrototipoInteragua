<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{
    protected $table ='TBL_PROCESO';

    protected $fillable = ['ID_PROCESO','DESCRIPCION','FECHA'];

    protected $primaryKey = 'ID_PROCESO';
    
    protected $timestamps = false;

    protected $dateFormat = 'dd/mm/yyyy';
}
