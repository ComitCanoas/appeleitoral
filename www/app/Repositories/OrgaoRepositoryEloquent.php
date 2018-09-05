<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OrgaoRepository;
use App\Entities\Orgao;
use App\Validators\OrgaoValidator;

/**
 * Class OrgaoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OrgaoRepositoryEloquent extends BaseRepository implements OrgaoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Orgao::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
