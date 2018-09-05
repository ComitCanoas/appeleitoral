<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Cargo.
 *
 * @package namespace App\Entities;
 */
class Cargo extends Model implements Transformable
{
    use TransformableTrait;

    const DEPUTADO_FEDERAL = 'DEPUTADO FEDERAL';
    const DEPUTADO_ESTADUAL = 'DEPUTADO ESTADUAL';
    const PREFEITO = 'PREFEITO';
    const VICE_PREFEITO = 'VICE-PREFEITO';
    const VEREADOR = 'VEREADOR';

    protected $table = 'cargo';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome'
    ];

    public function politicoEleicao()
    {
        return $this->hasMany(PoliticoEleicao::class);
    }

    public function prefeito()
    {
        return $this->hasOne(CidadePrefeito::class);
    }

    public function vicePrefeito()
    {
        return $this->hasOne(CidadeVicePrefeito::class);
    }

    public function candidatoPTB()
    {
        return $this->hasOne(CidadeCandidatoPTB::class);
    }
}
