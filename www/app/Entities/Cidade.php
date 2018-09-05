<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Cidade.
 *
 * @package namespace App\Entities;
 */
class Cidade extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'cidade';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'estado_id',
        'populacao',
        'numero_eleitores',
        'gentilico',
        'idh',
        'pib',
        'area_km2',
        'codigo_ibge',
        'codigo_tse',
    ];

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function presidenteCoordenador()
    {
        return $this->hasMany(PresidenteCoordenador::class);
    }

    public function apoiador()
    {
        return $this->hasMany(Apoiador::class);
    }

    public function recurso()
    {
        return $this->hasMany(Recurso::class);
    }

    public function visitas()
    {
        return $this->HasMany(Visita::class);
    }

    public function eleicao()
    {
        return $this->hasMany(Eleicao::class);
    }

    public function cidadePolitico()
    {
        return $this->hasOne(CidadePolitico::class);
    }
}
