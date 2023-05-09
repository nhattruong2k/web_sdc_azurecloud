<?php

namespace App\Tasks\GeneralSettings;

use Exception;
use App\Helpers\Cache;
use App\Libs\Constants;
use App\Cores\Abstracts\Task;
use App\Exceptions\NotFoundException;
use App\Exceptions\InternalErrorException;
use App\Repositories\Contracts\GeneralSettingRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateGeneralSettingTask extends Task
{

    protected GeneralSettingRepository $generalSettingRepository;

    public function __construct(GeneralSettingRepository $generalSettingRepository)
    {
        $this->generalSettingRepository = $generalSettingRepository;
    }

    public function run($data, int $id)
    {
        if (empty($data)) {
            throw new InternalErrorException(__('common.inputs_empty'));
        }
        try {
            $setting = $this->generalSettingRepository->update($data, $id);
            Cache::delete(Constants::$fileName['generalSetting']);
        } catch (ModelNotFoundException $ex) {
            throw new NotFoundException(__('common.not_found'));
        } catch (Exception $ex) {
            throw new InternalErrorException(__('roles.update_error'));
        }

        return $setting;
    }
}
