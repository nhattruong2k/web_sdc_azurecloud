<?php 
namespace App\Actions\Category;
use App\Cores\Abstracts\Action;
use App\Tasks\Category\GetPagingCategoryTask;

class GetPagingCategoryAction extends Action {
    public function run(array $param)
    {
        return resolve(GetPagingCategoryTask::class)->run($param);
    }
}

?>