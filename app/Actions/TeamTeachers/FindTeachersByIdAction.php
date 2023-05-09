<?php 
namespace App\Actions\TeamTeachers;
use App\Cores\Abstracts\Action;
use App\Tasks\TeamTeachers\FindTeachersByIdTask;

class FindTeachersByIdAction extends Action {
    public function run(int  $id, array $columns = ['*'])
    {
        return resolve(FindTeachersByIdTask::class)->run($id, $columns);
    }
}

?>