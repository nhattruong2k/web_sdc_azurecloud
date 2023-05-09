<?php 
namespace App\Actions\TeamStudents;
use App\Cores\Abstracts\Action;
use App\Tasks\TeamStudents\GetPagingStudentsTask;

class GetPagingStudentsAction extends Action {
    public function run(array $param)
    {
        return resolve(GetPagingStudentsTask::class)->run($param);
    }
}

?>