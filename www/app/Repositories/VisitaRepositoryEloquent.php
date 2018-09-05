<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\VisitaRepository;
use App\Entities\Visita;
use App\Validators\VisitaValidator;

/**
 * Class VisitaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class VisitaRepositoryEloquent extends BaseRepository implements VisitaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Visita::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
