<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Politico.
 *
 * @package namespace App\Entities;
 */
class Politico extends Model implements Transformable
{
    use TransformableTrait;

    use SoftDeletes;

    protected $table = 'politico';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'endereco',
        'email',
        'data_nascimento',
        'cep',
        'telefone',
        'foto',
        'cpf',
        'link_foto'
    ];

    public function politicoEleicao()
    {
        return $this->hasMany(PoliticoEleicao::class);
    }

	public function getPoliticoEleicao()
	{//dd($this->politicoEleicao->last());
		return $this->politicoEleicao->last();
	}

    public function prefeito()
    {
        return $this->hasOne(CidadePolitico::class, 'prefeito_id', 'id');
    }

    public function vicePrefeito()
    {
        return $this->hasOne(CidadePolitico::class, 'vice_prefeito_id', 'id');
    }

    public function candidatoPTB()
    {
        return $this->hasOne(CidadePolitico::class, 'candidato_ptb_id', 'id');
    }

}
