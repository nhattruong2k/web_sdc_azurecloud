<?php

namespace App\Tasks\Projectstudents;

use App\Cores\Abstracts\Task;
use App\Exceptions\NotFoundException;
use App\Exceptions\UpdateResourceFailedException;
use Exception;
use App\Exceptions\InternalErrorException;
use App\Repositories\Contracts\ProjectStudentsRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateProjectStudentTask extends Task
{

    protected ProjectStudentsRepository $projectStudentsRepository;

    public function __construct(ProjectStudentsRepository $projectStudentsRepository)
    {
        $this->projectStudentsRepository = $projectStudentsRepository;
    }

    public function run($data, int $projectId)
    {
        if (empty($data)) {
            throw new InternalErrorException(__('common.inputs_empty'));
        }
        try {
            $projectStudent = $this->projectStudentsRepository->update($data, $projectId);
        } catch (ModelNotFoundException $ex) {
            throw new NotFoundException(__('common.not_found'));
        } catch (Exception $ex) {
            throw new InternalErrorException(__('project_students.update_error'));
        }

        return $projectStudent;
    }
}
