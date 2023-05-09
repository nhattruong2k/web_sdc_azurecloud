<?php 

namespace App\Tasks\TeamTeachers;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\TeachersRepository;
use App\Exceptions\InternalErrorException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\NotFoundException;

class UpdateTeachersTask extends Task {
    protected TeachersRepository $teachersRepository;
    public function __construct(TeachersRepository $teachersRepository)
    {
        $this->teachersRepository = $teachersRepository;
    }

    public function run($data, int $teacherId)
    {
        if (empty($data)) {
            throw new InternalErrorException(__('common.inputs_empty'));
        }
        try {
            $teachers = $this->teachersRepository->update($data, $teacherId);
        } catch (ModelNotFoundException $ex) {
            throw new NotFoundException(__('common.not_found'));
        } catch (Exception $ex) {
            throw new InternalErrorException(__('category.update_error'));
        }
        return $teachers;
    }
}
?>