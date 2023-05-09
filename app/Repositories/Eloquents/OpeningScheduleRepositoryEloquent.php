<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\OpeningScheduleRepository;
use App\Models\OpeningSchedule;
use App\Validators\OpeningScheduleValidator;

/**
 * Class OpeningScheduleRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class OpeningScheduleRepositoryEloquent extends BaseRepository implements OpeningScheduleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OpeningSchedule::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
