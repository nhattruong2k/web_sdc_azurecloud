<?php 
namespace App\Actions\statistNumbers;
use App\Cores\Abstracts\Action;
use App\Tasks\StatistNumbers\GetPagingStatistNumbersTask;

class GetPagingStatistNumbersAction extends Action {
    public function run(array $param)
    {
        return resolve(GetPagingStatistNumbersTask::class)->run($param);
    }
}

?>