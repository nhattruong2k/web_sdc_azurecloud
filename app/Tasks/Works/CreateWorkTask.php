<?php

namespace App\Tasks\Works;

use App\Cores\Abstracts\Task;
use App\Exceptions\InternalErrorException;
use App\Repositories\Contracts\WorksRepository;
use Exception;

class CreateWorkTask extends Task
{

    protected WorksRepository $worksRepository;

    public function __construct(WorksRepository $worksRepository)
    {
        $this->worksRepository = $worksRepository;
    }

    /**
     * @param array $data
     * @return mixed
     * @throws InternalErrorException
     */
    public function run(array $data)
    {
        try {
            $work = $this->worksRepository->create($data);
        } catch (Exception $ex) {
            throw new InternalErrorException(__('works.create_error'));
        }
        return $work;
    }
}
