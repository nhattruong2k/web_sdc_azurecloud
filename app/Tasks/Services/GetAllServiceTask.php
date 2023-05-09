<?php

namespace App\Tasks\Services;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\ServiceRepository;

class GetAllServiceTask extends Task
{
    protected ServiceRepository $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function run($columns = ['*'])
    {
        $columns = [
            'id',
            'title',
            'slug',
            'description',
            'link',
            'logo',
        ];
        return $this->serviceRepository->active()->get($columns);
    }
}
