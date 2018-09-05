<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TipoRepository;
use App\Entities\Tipo;
use App\Validators\TipoValidator;

/**
 * Class TipoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TipoRepositoryEloquent extends BaseRepository implements TipoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Tipo::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
