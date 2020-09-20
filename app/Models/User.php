<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    const CREATED_AT = 'fecha_reg';
    const UPDATED_AT = 'fecha_mod';
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_usuario';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_usuario',
        'cedula',
        'nombre',
        'apellido',
        'sexo',
        'telefono',
        'fecha_nacimiento',
        'direccion',
        'email',
        'password',
        'id_rol',
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
    protected $primaryKey = 'id_usuario';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'dd/mm/yyyy';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    /*protected $casts = [
        'email_verified_at' => 'datetime',
    ];*/

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function adminlte_image()
    {
        return 'https://picsum.photos/300/300';
    }

    public function adminlte_desc()
    {
        return 'Administrador';
    }

    public function adminlte_profile_url()
    {
        return 'profile/username';
    }
}
