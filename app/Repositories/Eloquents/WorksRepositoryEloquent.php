<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\Work;
use App\Repositories\Contracts\WorksRepository;

/**
 * Class CourseRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class WorksRepositoryEloquent extends BaseRepository implements WorksRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Work::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
