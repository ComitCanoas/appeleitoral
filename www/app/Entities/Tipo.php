<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Tipo.
 *
 * @package namespace App\Entities;
 */
class Tipo extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'tipo';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome'
    ];

    public function presidenteCoordenador()
    {
        return $this->belongsToMany(Tipo::class);
    }


}
