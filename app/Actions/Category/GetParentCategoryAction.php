<?php
namespace App\Actions\Category;

use App\Cores\Abstracts\Action;
use App\Tasks\Category\GetParentCategoryTask;
use App\Models\Category;
use App\Tasks\Category\GetListCategoryactionTask;
use App\Tasks\Category\GetListAllCategoryactionTask;

class GetParentCategoryAction extends Action {
    public function run($id = null, $cate_news = false, array $columns = ['*']){
        $getCategories = resolve(GetListCategoryactionTask::class)->run($id,$cate_news,$columns);
        if(!empty($id) && $cate_news == false){
            $category = resolve(FindCategoryByIdAction::class)->run($id);
            return resolve(GetParentCategoryTask::class)->run($getCategories,  $category->parent_id);
        }
        if($cate_news == true){
            $category = resolve(FindCategoryByIdAction::class)->run($id);
            return resolve(GetParentCategoryTask::class)->run($getCategories, $category->id);
        }
        return resolve(GetParentCategoryTask::class)->run($getCategories);
    }
}
?>