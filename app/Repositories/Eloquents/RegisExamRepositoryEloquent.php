<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\RegisExamRepository;
use App\Models\RegisExam;
use App\Validators\RegisExamValidator;

/**
 * Class RegisExamRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class RegisExamRepositoryEloquent extends BaseRepository implements RegisExamRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RegisExam::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
