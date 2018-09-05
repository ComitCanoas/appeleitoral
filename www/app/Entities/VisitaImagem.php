<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class VisitaImagem.
 *
 * @package namespace App\Entities;
 */
class VisitaImagem extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'visita_imagem';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'visita_id',
        'nomeExtensao'
    ];

    public function visita()
    {
        return $this->belongsTo(Visita::class, 'visita_id');
    }

}
