<?php
namespace App\Tasks\Services;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\ServiceRepository;
use Exception;
use App\Exceptions\NotFoundException;

class FindServiceByIdTask extends Task{
    protected $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }


    public function run(int $id, $columns = ['*'])
    {
        try {
            $service = $this->serviceRepository->find($id, $columns);
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $service;
    }
}
?>
