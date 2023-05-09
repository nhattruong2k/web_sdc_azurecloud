<?php

namespace App\Repositories\Eloquents;

use App\Models\StatistNumber;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\StatistNumbersRepository;

/**
 * Class PermissionsRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class StatistNumbersRepositoryEloquent extends BaseRepository implements StatistNumbersRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return StatistNumber::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
