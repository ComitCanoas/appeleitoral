<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Eleicao.
 *
 * @package namespace App\Entities;
 */
class Eleicao extends Model implements Transformable
{
    use TransformableTrait;

    const DEPUTADO = 'D';
    const VEREADOR = 'V';

    protected $table = 'eleicao';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ano_eleicao',
        'cidade_id'
    ];

    public function cidade()
    {
        return $this->belongsToMany(Cidade::class);
    }

    public function politicoEleicao()
    {
        return $this->hasMany(PoliticoEleicao::class);
    }

}
