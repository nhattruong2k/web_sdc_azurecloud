<?php

namespace App\Repositories\Eloquents;

use App\Models\TeamStudents;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\StudentsRepository;

/**
 * Class PermissionsRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class StudentsRepositoryEloquent extends BaseRepository implements StudentsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TeamStudents::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
