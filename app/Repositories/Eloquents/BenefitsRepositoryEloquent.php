<?php

namespace App\Repositories\Eloquents;

use App\Models\Benefit;
use App\Repositories\Contracts\BenefitsRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class PermissionsRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class BenefitsRepositoryEloquent extends BaseRepository implements BenefitsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Benefit::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
