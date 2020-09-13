<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table ='TBL_MENU';

    protected $fillable = ['ID_MENU','NOMBRE','ICONO'];

    protected $primaryKey = 'ID_MENU';
    
    protected $timestamps = false;

    protected $dateFormat = 'dd/mm/yyyy';
}
