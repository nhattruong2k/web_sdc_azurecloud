<?php

namespace App\Repositories\Eloquents;

use App\Models\Config;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\ConfigRepository;

/**
 * Class PermissionsRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class ConfigRepositoryEloquent extends BaseRepository implements ConfigRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Config::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
