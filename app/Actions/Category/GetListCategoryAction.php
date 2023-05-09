<?php 
namespace App\Actions\Category;
use App\Cores\Abstracts\Action;
use App\Tasks\Category\GetParentCategoryTask;

class GetListCategoryAction extends Action {
    public function run(array $columns = ['*']){
        return resolve(GetParentCategoryTask::class)->run($columns);
    }
}

?>