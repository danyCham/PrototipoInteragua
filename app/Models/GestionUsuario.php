<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\User;

class GestionUsuario extends Authenticatable

{

    const CREATED_AT = 'fecha_reg';
    const UPDATED_AT = 'fecha_mod';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_gestion_usuario';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_gestion_usuario',
        'id_usuario', 
        'social_id', 
        'social_name', 
        'imagen',
        'token',
        'clave_temporal',
        'fecha_clave_temporal',
        'estado_clave',
        'estado_usuario',
        'usuario_reg',
        'fecha_reg',
        'usuario_mod',
        'fecha_mod',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_gestion_usuario';

    //Relacion uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }    
}
