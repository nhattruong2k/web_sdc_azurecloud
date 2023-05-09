<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\ListExamsRepository;
use App\Models\ListExams;
use App\Validators\ListExamsValidator;

/**
 * Class ListExamsRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class ListExamsRepositoryEloquent extends BaseRepository implements ListExamsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ListExams::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
