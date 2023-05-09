<?php
namespace App\Tasks\Services;
use App\Cores\Abstracts\Task;
use App\Exceptions\InternalErrorException;
use App\Repositories\Contracts\ServiceRepository;
use Exception;

class CreateServiceTask extends Task {
    protected ServiceRepository $serviceRepository;
    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function run(array $data)
    {
        try {
            $services = $this->serviceRepository->create($data);
        } catch (Exception $ex) {
            throw new InternalErrorException(__('services.create_error'));
        }
        return $services;
    }
}
?>
