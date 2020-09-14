<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuRol extends Model
{
    protected $table ='TBL_MENU_ROL';

    protected $fillable = ['ID_MENU_ROL','ID_SUB_MENU','ID_ROL', 'GESTION','ESTADO','USUARIO_CREA','FECHA_CREA','USUARIO_MOD','FECHA_MOD','USUARIO_ELIM','FECHA_ELIM'];

    protected $primaryKey = 'ID_MENU_ROL';
    
    public $timestamps = false;

    protected $dateFormat = 'dd/mm/yyyy';
}
