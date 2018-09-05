<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Recurso.
 *
 * @package namespace App\Entities;
 */
class Recurso extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'recurso';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgao_id',
        'cidade_id',
        'ano',
        'instituicao',
        'valor',
        'acao',
        'situacao',
        'processo'
    ];

    public function orgao()
    {
        return $this->belongsTo(Orgao::class, 'orgao_id');
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class, 'cidade_id');
    }

}
