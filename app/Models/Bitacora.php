<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $table ='TBL_BITACORA';

    protected $fillable = ['ID_BITACORA','ID_PROCESO','DETALLE','FECHA'];

    protected $primaryKey = 'ID_BITACORA';
    
    protected $dateFormat = 'dd/mm/yyyy';

    public $timestamps = false;
}
