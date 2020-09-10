<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table ='tbl_usuario';

    protected $fillable = ['ID_USUARIO','CEDULA','NOMBRE','APELLIDO','SEXO','TELEFONO','FECHA_NACIMIENTO','DIRECCION','CORREO','CONTRASENIA','ID_ROL'];

    protected $primaryKey = 'ID_USUARIO';
    
    protected $dateFormat = 'dd/mm/yyyy';

    protected $timestamps = false;
}
