<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\ConsultationRepository;
use App\Models\Consultation;
use App\Validators\ConsultationValidator;

/**
 * Class ConsultationRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class ConsultationRepositoryEloquent extends BaseRepository implements ConsultationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Consultation::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
