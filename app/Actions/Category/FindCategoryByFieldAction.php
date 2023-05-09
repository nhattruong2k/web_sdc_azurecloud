<?php
namespace App\Actions\Category;


use App\Cores\Abstracts\Action;
use App\Tasks\Category\FindCategoryByFieldTask;

class FindCategoryByFieldAction extends Action
{
    public function run($field, $value){
        return resolve(FindCategoryByFieldTask::class)->run($field, $value);
    }
}
?>