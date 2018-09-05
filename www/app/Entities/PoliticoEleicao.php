<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class PoliticoEleicao.
 *
 * @package namespace App\Entities;
 */
class PoliticoEleicao extends Model implements Transformable
{
    use TransformableTrait;

    use SoftDeletes;

    const ELEITO = 'S';
    const NAO_ELEITO = 'N';

    protected $table = 'politico_eleicao';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'politico_id',
        'eleicao_id',
        'cargo_id',
        'eleito',
        'partido',
        'coligacao',
        'quantidade_votos'
    ];

    public function politico()
    {
        return $this->belongsTo(Politico::class);
    }

    public function eleicao()
    {
        return $this->belongsTo(Eleicao::class);
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }
}
