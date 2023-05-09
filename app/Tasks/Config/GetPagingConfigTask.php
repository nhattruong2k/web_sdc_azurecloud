<?php

namespace App\Tasks\Config;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\ConfigRepository;

class GetPagingConfigTask extends Task
{
    protected ConfigRepository $configRepository;

    public function __construct(ConfigRepository $configRepository)
    {
        $this->configRepository = $configRepository;
    }

    public function run(array $param, array $columns = ['*'])
    {
        $columns = [
            'config.id',
            'config.key',
            'config.value',
            'config.status',
        ];
        $config = $this->configRepository->scopeQuery(function ($q) use ($param){
            if (isset($param['search']) && $param['search']){
                $q->where('config.key', 'like', "%" . $param['search'] . "%")
                    ->orWhere('config.value', 'like', "%" . $param['search'] . "%");
            }
            return $q;
        });
        $config->orderBy($param['sortfield'], $param['sorttype']);
   
        return $config->paginate($param['limit'], $columns);
    }
}