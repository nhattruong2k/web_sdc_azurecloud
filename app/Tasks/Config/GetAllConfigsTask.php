<?php

namespace App\Tasks\Config;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\ConfigRepository;
use App\Helpers\Cache;
use App\Libs\Constants;

class GetAllConfigsTask extends Task
{
    protected ConfigRepository $configRepository;

    public function __construct(ConfigRepository $configRepository) {
        $this->configRepository = $configRepository;
    }

    public function run($column = ['*']){
        $column = ['key','value'];
        if (empty(Cache::read(Constants::$fileName['configs']))){
            $configs = $this->configRepository->active()->select($column)->get();
            $arr_configs = [];
            foreach($configs as $config){
                $arr_configs[$config["key"]] =  $config["value"];
            }
            Cache::write(Constants::$fileName['configs'],json_encode($arr_configs));
        }
        $data = Cache::read(Constants::$fileName['configs']);
        return $data;
    }
}
