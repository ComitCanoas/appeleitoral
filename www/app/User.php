<?php

namespace App;

use App\Entities\Role;
use App\Entities\UserRole;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    const ROLE_ADMIN = 1;
    const ROLE_CADASTRO = 2;
    const ROLE_CONSULTA = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userRole()
    {
        return $this->hasOne(UserRole::class);
    }

    public function isAdministrador() {
        return $this->verificarSeUsuarioTemPerfil(self::ROLE_ADMIN);
    }

    public function isCadastro() {
        return $this->verificarSeUsuarioTemPerfil(self::ROLE_CADASTRO);
    }

    public function isConsulta() {
        return $this->verificarSeUsuarioTemPerfil(self::ROLE_CONSULTA);
    }

    private function verificarSeUsuarioTemPerfil($perfil)
    {
        return ($this->userRole()->where('role_id', '=',$perfil)->first()) ? true : false;
    }

    public function sendPasswordResetNotification($token)
    {
        // Não esquece: use App\Notifications\ResetPassword;
        $this->notify(new ResetPassword($token));
    }
}
