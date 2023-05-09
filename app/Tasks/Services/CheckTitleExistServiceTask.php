<?php
namespace App\Tasks\Services;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\ServiceRepository;

class CheckTitleExistServiceTask extends Task
{
    protected $serviceRepository;
    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function run($title, $id = null)
    {
        return $this->serviceRepository->scopeQuery(function ($query) use($title, $id) {
            $query = $query->whereTitle($title);
            if (!empty($id)) {
                $query = $query->where('id', '!=', $id);
            }
            return $query;
        })->exists();
    }
}
