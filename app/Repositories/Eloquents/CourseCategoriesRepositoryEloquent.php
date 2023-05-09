<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\CourseCategoriesRepository;
use App\Models\CourseCategories;
use App\Validators\CourseCategoriesValidator;

/**
 * Class CourseCategoriesRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class CourseCategoriesRepositoryEloquent extends BaseRepository implements CourseCategoriesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CourseCategories::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
