<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Orgao.
 *
 * @package namespace App\Entities;
 */
class Orgao extends Model implements Transformable
{
    use TransformableTrait;


    protected $table = 'orgao';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome'
    ];

    public function recurso()
    {
        return $this->hasMany(Recurso::class);
    }
}
