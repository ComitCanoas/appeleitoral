<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class PresidenteCoordenador.
 *
 * @package namespace App\Entities;
 */
class PresidenteCoordenador extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'presidente_coordenador';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cidade_id',
        'tipo_id',
        'nome',
        'endereco',
        'email',
        'telefone',
        'foto',
        'link_foto'
    ];

    public function cidade()
    {
        return $this->belongsTo(Cidade::class, 'cidade_id');
    }

    public function tipo()
    {
        return $this->belongsTo(Tipo::class, 'tipo_id');
    }

}
