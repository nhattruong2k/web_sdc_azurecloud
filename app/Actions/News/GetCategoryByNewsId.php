<?php
namespace App\Actions\News;

use App\Cores\Abstracts\Action;
use App\Tasks\News\GetParentCategoryByNewsTask;
use App\Models\Category;
use App\Tasks\Category\GetListCategoryactionTask;

class GetCategoryByNewsId extends Action {
    public function run($category_id, array $columns = ['*']){
        $getCategories = resolve(GetListCategoryactionTask::class)->run($columns);
        return resolve(GetParentCategoryByNewsTask::class)->run($getCategories,$category_id);
    }
}
?>