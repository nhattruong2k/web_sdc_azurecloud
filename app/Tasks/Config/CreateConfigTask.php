<?php

namespace App\Tasks\Config;

use App\Cores\Abstracts\Task;
use App\Exceptions\InternalErrorException;
use App\Repositories\Contracts\ConfigRepository;
use Exception;
use App\Helpers\Cache;
use App\Libs\Constants;

class CreateConfigTask extends Task
{

    public ConfigRepository $configRepository;
    public function __construct(ConfigRepository $configRepository)
    {
        $this->configRepository = $configRepository;
    }
    public function run(array $data)
    {
        try {
            $config = $this->configRepository->create($data);
            Cache::delete(Constants::$fileName['configs']);
        } catch (Exception $ex) {
            throw new InternalErrorException(__('config.create_error'));   
        }
        return $config;
    }
}
