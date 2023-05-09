<?php

namespace App\Tasks\Works;

use App\Cores\Abstracts\Task;
use App\Exceptions\NotFoundException;
use App\Repositories\Contracts\WorksRepository;
use Exception;

class FindWorkByIdTask extends Task
{
    protected WorksRepository $worksRepository;

    public function __construct(WorksRepository $worksRepository)
    {
        $this->worksRepository = $worksRepository;
    }

    public function run(int $id, $columns = ['*'])
    {
        try {
            $work = $this->worksRepository->find($id, $columns);
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $work;
    }
}
