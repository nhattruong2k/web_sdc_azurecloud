<?php

namespace App\Repositories\Eloquents;

use App\Models\Category;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\CategoryRepository;
use App\Validators\CategoryValidator;

/**
 * Class UsersRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
