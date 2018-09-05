<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ApoiadorRepository;
use App\Entities\Apoiador;
use App\Validators\ApoiadorValidator;

/**
 * Class ApoiadorRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ApoiadorRepositoryEloquent extends BaseRepository implements ApoiadorRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Apoiador::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
