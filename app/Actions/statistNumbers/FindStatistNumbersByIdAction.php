<?php
namespace  App\Actions\statistNumbers;

use App\Cores\Abstracts\Action;
use App\Tasks\StatistNumbers\FindStatistNumbersByIdTask;

class FindStatistNumbersByIdAction extends Action{

    public function run(int  $id, array $columns = ['*'])
    {
        return resolve(FindStatistNumbersByIdTask::class)->run($id, $columns);
    }
}

?>