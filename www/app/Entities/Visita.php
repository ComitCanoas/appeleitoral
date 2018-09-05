<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Visita.
 *
 * @package namespace App\Entities;
 */
class Visita extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'visita';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cidade_id',
        'data',
        'titulo',
        'descricao'
    ];

    public function cidade()
    {
        return $this->belongsTo(Cidade::class, 'cidade_id');
    }

    public function imagens()
    {
        return $this->hasMany(VisitaImagem::class);
    }


}
