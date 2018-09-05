<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Apoiador.
 *
 * @package namespace App\Entities;
 */
class Apoiador extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'apoiador';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cidade_id',
        'nome',
        'telefone',
        'email',
        'endereco',
        'foto',
        'link_foto'
    ];

    public function cidade()
    {
        return $this->belongsTo(Cidade::class, 'cidade_id');
    }

}
