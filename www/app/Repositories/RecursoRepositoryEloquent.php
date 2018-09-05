<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RecursoRepository;
use App\Entities\Recurso;
use App\Validators\RecursoValidator;

/**
 * Class RecursoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RecursoRepositoryEloquent extends BaseRepository implements RecursoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Recurso::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
