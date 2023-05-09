<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\GeneralSettingRepository;
use App\Models\GeneralSetting;
use App\Validators\GeneralSettingValidator;

/**
 * Class GeneralSettingRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class GeneralSettingRepositoryEloquent extends BaseRepository implements GeneralSettingRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return GeneralSetting::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getFormData()
    {
        return $this->model()::first();
    }

    public function updateValueByKey($key, $value)
    {
        return $this->model::where('key', '=', $key)->update(['value' => $value]);
    }
}
