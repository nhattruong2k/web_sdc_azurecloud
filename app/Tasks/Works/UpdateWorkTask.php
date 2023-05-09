<?php

namespace App\Tasks\Works;

use App\Cores\Abstracts\Task;
use App\Exceptions\NotFoundException;
use Exception;
use App\Exceptions\InternalErrorException;
use App\Repositories\Contracts\WorksRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateWorkTask extends Task
{

    protected WorksRepository $worksRepository;

    public function __construct(WorksRepository $worksRepository)
    {
        $this->worksRepository = $worksRepository;
    }

    public function run($data, int $id)
    {
        if (empty($data)) {
            throw new InternalErrorException(__('common.inputs_empty'));
        }
        try {
            $work = $this->worksRepository->update($data, $id);
        } catch (ModelNotFoundException $ex) {
            throw new NotFoundException(__('common.not_found'));
        } catch (Exception $ex) {
            throw new InternalErrorException(__('roles.update_error'));
        }

        return $work;
    }
}
