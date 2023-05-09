<?php
namespace App\Actions\Services;
use App\Cores\Abstracts\Action;
use App\Tasks\Services\GetPagingServiceTask;

class GetPagingServiceAction extends Action {
    public function run(array $param)
    {
        return resolve(GetPagingServiceTask::class)->run($param);
    }
}

?>
