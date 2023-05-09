<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\ActivityLogRepository;
use App\Models\ActivityLog;
use App\Validators\ActivityLogValidator;

/**
 * Class ActivityLogRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class ActivityLogRepositoryEloquent extends BaseRepository implements ActivityLogRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ActivityLog::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
