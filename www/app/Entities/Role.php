<?php

namespace App\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Role.
 *
 * @package namespace App\Entities;
 */
class Role extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nome'];

    public function userRole()
    {
        return $this->hasMany(UserRole::class,'role_id');
    }
}
