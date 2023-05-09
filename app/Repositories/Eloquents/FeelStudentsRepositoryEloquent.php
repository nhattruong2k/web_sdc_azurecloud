<?php

namespace App\Repositories\Eloquents;

use App\Models\FeelStudent;
use App\Repositories\Contracts\FeelStudentsRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class CourseRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class FeelStudentsRepositoryEloquent extends BaseRepository implements FeelStudentsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return FeelStudent::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
