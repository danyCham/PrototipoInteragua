<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    protected $table ='TBL_SUB_MENU';

    protected $fillable = ['ID_SUB_MENU','NOMBRE', 'ID_MENU'];

    protected $primaryKey = 'ID_SUB_MENU';
    
    protected $timestamps = false;

    protected $dateFormat = 'dd/mm/yyyy';
}
