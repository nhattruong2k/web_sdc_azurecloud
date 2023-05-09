<?php

namespace App\Tasks\Services;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\ServiceRepository;

class GetPagingServiceTask extends Task
{

    protected $serviceRepository;
    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function run(array $param, array $columns = ['*'])
    {

        $columns = [
            'services.id',
            'services.title',
            'services.slug',
            'services.description',
            'services.logo',
            'services.link',
            'services.status',
        ];
        $services = $this->serviceRepository->scopeQuery(function ($query) use ($param) {
            if ((isset($param['search']) && $param['search'])) {
                $query->where('services.title', 'like', "%" . $param['search'] . "%");
            }

            if (!empty($param['status'])) {
                $query->where('services.status', $param['status']);
            }
            return $query;
        });
        $services->orderBy($param['sortfield'], $param['sorttype']);
        return $services->paginate($param['limit'], $columns);
    }
}
