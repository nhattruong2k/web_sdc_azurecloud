<?php

namespace App\Tasks\GeneralSettings;

use Exception;
use App\Helpers\Cache;
use App\Libs\Constants;
use App\Cores\Abstracts\Task;
use App\Exceptions\InternalErrorException;
use App\Repositories\Contracts\GeneralSettingRepository;

class CreateGeneralSettingTask extends Task
{

    protected GeneralSettingRepository $generalSettingRepository;

    public function __construct(GeneralSettingRepository $generalSettingRepository)
    {
        $this->generalSettingRepository = $generalSettingRepository;
    }

    /**
     * @param array $data
     * @return mixed
     * @throws InternalErrorException
     */
    public function run(array $data)
    {
        try {
            $setting = $this->generalSettingRepository->create($data);
            Cache::delete(Constants::$fileName['generalSetting']);
        } catch (Exception $ex) {
            throw new InternalErrorException(__('general_settings.create_error'));
        }
        return $setting;
    }
}
