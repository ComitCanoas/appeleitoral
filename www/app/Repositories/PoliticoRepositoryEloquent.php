<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PoliticoRepository;
use App\Entities\Politico;
use App\Validators\PoliticoValidator;

/**
 * Class PoliticoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PoliticoRepositoryEloquent extends BaseRepository implements PoliticoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Politico::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
