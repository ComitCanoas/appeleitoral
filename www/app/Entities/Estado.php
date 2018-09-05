<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Estado.
 *
 * @package namespace App\Entities;
 */
class Estado extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'estado';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome'
    ];

    public function cidade()
    {
        return $this->hasMany(Cidade::class);
    }


}
