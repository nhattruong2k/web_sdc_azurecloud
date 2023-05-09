<?php

namespace App\Tasks\Config;

use App\Cores\Abstracts\Task;
use App\Exceptions\NotFoundException;
use App\Repositories\Contracts\ConfigRepository;
use Exception;

class FindConfigByIdTask extends Task
{
    protected ConfigRepository $configRepository;

    public function __construct(configRepository $configRepository) {
        $this->configRepository = $configRepository;
    }

    public function run(int $id, $columns = ['*'])
    {
        try {
            $config = $this->configRepository->find($id, $columns);
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $config;
    }
}
