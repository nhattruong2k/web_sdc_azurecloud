<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface GeneralSettingRepository.
 *
 * @package namespace App\Repositories\Contracts;
 */
interface GeneralSettingRepository extends RepositoryInterface
{
    public function getFormData();
    public function updateValueByKey($key, $value);
}
