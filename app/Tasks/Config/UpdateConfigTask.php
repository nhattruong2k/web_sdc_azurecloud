<?php

namespace App\Tasks\Config;

use App\Cores\Abstracts\Task;
use App\Exceptions\NotFoundException;
use App\Exceptions\UpdateResourceFailedException;
use Exception;
use App\Exceptions\InternalErrorException;
use App\Repositories\Contracts\ConfigRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Helpers\Cache;
use App\Libs\Constants;

class UpdateConfigTask extends Task
{

    protected ConfigRepository $configRepository;

    public function __construct(ConfigRepository $configRepository)
    {
        $this->configRepository = $configRepository;
    }

    public function run($data, int $bannerId)
    {
        if (empty($data)) {
            throw new InternalErrorException(__('common.inputs_empty'));
        }
        try {
            $config = $this->configRepository->update($data, $bannerId);
            Cache::delete(Constants::$fileName['configs']);
        } catch (ModelNotFoundException $ex) {
            throw new NotFoundException(__('common.not_found'));
        } catch (Exception $ex) {
            throw new InternalErrorException(__('config.update_error'));
        }
        return $config;
    }
}
