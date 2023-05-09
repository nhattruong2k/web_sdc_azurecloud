<?php
namespace  App\Actions\Category;

use App\Cores\Abstracts\Action;
use App\Tasks\Category\FindCategoryByIdTask;

class FindCategoryByIdAction extends Action{

    public function run(int  $id, array $columns = ['*'])
    {
        return resolve(FindCategoryByIdTask::class)->run($id, $columns);
    }
}

?>