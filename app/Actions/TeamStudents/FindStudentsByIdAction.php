<?php 
namespace App\Actions\TeamStudents;
use App\Cores\Abstracts\Action;
use App\Tasks\TeamStudents\FindStudentsByIdTask;

class FindStudentsByIdAction extends Action {
    public function run(int  $id, array $columns = ['*'])
    {
        return resolve(FindStudentsByIdTask::class)->run($id, $columns);
    }
}

?>