<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\PermissionsRepository;
use App\Models\Permissions;
use App\Validators\PermissionsValidator;

/**
 * Class PermissionsRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class PermissionsRepositoryEloquent extends BaseRepository implements PermissionsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permissions::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
