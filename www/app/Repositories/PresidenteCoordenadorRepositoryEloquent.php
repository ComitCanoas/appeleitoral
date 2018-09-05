<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PresidenteCoordenadorRepository;
use App\Entities\PresidenteCoordenador;
use App\Validators\PresidenteCoordenadorValidator;

/**
 * Class PresidenteCoordenadorRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PresidenteCoordenadorRepositoryEloquent extends BaseRepository implements PresidenteCoordenadorRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PresidenteCoordenador::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
