<?php 
namespace App\Actions\News;
use App\Cores\Abstracts\Action;
use App\Tasks\News\FindNewsByIdTask;

class FindNewsByIdAction extends Action {
    public function run(int  $id, array $columns = ['*'])
    {
        return resolve(FindNewsByIdTask::class)->run($id, $columns);
    }
}

?>