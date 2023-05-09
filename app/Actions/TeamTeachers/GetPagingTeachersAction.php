<?php 
namespace App\Actions\TeamTeachers;
use App\Cores\Abstracts\Action;
use App\Tasks\TeamTeachers\GetPagingTeachersTask;

class GetPagingTeachersAction extends Action {
    public function run(array $param)
    {
        return resolve(GetPagingTeachersTask::class)->run($param);
    }
}

?>