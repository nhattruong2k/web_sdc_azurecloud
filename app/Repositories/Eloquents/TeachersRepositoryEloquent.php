<?php

namespace App\Repositories\Eloquents;

use App\Models\TeamTeachers;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\TeachersRepository;

/**
 * Class PermissionsRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class TeachersRepositoryEloquent extends BaseRepository implements TeachersRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TeamTeachers::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
