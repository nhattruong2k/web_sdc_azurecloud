<?php 

namespace App\Tasks\TeamStudents;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\StudentsRepository;
use App\Exceptions\InternalErrorException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\NotFoundException;

class UpdateStudentsTask extends Task {
    protected StudentsRepository $studentsRepository;
    public function __construct(StudentsRepository $studentsRepository)
    {
        $this->studentsRepository = $studentsRepository;
    }

    public function run($data, int $studentId)
    {
        if (empty($data)) {
            throw new InternalErrorException(__('common.inputs_empty'));
        }
        try {
            $students= $this->studentsRepository->update($data, $studentId);
        } catch (ModelNotFoundException $ex) {
            throw new NotFoundException(__('common.not_found'));
        } catch (Exception $ex) {
            throw new InternalErrorException(__('category.update_error'));
        }
        return $students;
    }
}
?>