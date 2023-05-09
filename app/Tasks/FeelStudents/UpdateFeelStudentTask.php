<?php

namespace App\Tasks\FeelStudents;

use App\Cores\Abstracts\Task;
use App\Exceptions\NotFoundException;
use App\Exceptions\UpdateResourceFailedException;
use Exception;
use App\Exceptions\InternalErrorException;
use App\Repositories\Contracts\FeelStudentsRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateFeelStudentTask extends Task
{
    protected FeelStudentsRepository $feelStudentsRepository;

    public function __construct(FeelStudentsRepository $feelStudentsRepository)
    {
        $this->feelStudentsRepository = $feelStudentsRepository;
    }

    public function run($data, int $id)
    {
        if (empty($data)) {
            throw new InternalErrorException(__('common.inputs_empty'));
        }
        try {
            $feelStudent = $this->feelStudentsRepository->update($data, $id);
        } catch (ModelNotFoundException $ex) {
            throw new NotFoundException(__('common.not_found'));
        } catch (Exception $ex) {
            throw new InternalErrorException(__('feel_students.update_error'));
        }

        return $feelStudent;
    }
}
