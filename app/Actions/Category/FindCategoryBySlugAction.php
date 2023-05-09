<?php

namespace  App\Actions\Category;

use App\Cores\Abstracts\Action;
use App\Tasks\Category\FindCategoryBySlugTask;

class FindCategoryBySlugAction extends Action{

    public function run(string $param, $columns = ['*'])
    {
        return resolve(FindCategoryBySlugTask::class)->run($param, $columns);
    }
}

?>