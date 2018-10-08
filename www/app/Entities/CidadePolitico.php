<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class CidadePolitico.
 *
 * @package namespace App\Entities;
 */
class CidadePolitico extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'cidade_politico';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cidade_id',
        'prefeito_id',
        'vice_prefeito_id',
        'candidato_ptb_id'
    ];

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }

    public function prefeito()
    {
        return $this->belongsTo(Politico::class, 'prefeito_id');
    }

    public function vicePrefeito()
    {
        return $this->belongsTo(Politico::class, 'vice_prefeito_id');
    }

    public function candidatoPTB()
    {
        return $this->belongsTo(Politico::class, 'candidato_ptb_id');
    }


}
