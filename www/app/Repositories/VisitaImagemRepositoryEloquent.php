<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\VisitaImagemRepository;
use App\Entities\VisitaImagem;
use App\Validators\VisitaImagemValidator;

/**
 * Class VisitaImagemRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class VisitaImagemRepositoryEloquent extends BaseRepository implements VisitaImagemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return VisitaImagem::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
