<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PoliticoEleicaoRepository;
use App\Entities\PoliticoEleicao;
use App\Validators\PoliticoEleicaoValidator;

/**
 * Class PoliticoEleicaoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PoliticoEleicaoRepositoryEloquent extends BaseRepository implements PoliticoEleicaoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PoliticoEleicao::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
