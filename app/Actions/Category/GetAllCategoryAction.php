<?php


namespace App\Actions\Category;


use App\Cores\Abstracts\Action;
use App\Tasks\Category\GetAllCategoryTask;
use App\Tasks\Category\GetParentCategoryTask;

class GetAllCategoryAction extends Action
{
    public function run(){
        $categories =  resolve(GetAllCategoryTask::class)->run();
        return resolve(GetParentCategoryTask::class)->buildTree($categories);
    }
}
