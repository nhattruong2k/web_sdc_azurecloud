<?php
namespace App\Actions\CourseCategories;
use App\Cores\Abstracts\Action;
use App\Tasks\CourseCategories\GetPagingCourseCategoryTask;

class GetPagingCourseCategoryAction extends Action {
    public function run(array $param)
    {
        return resolve(GetPagingCourseCategoryTask::class)->run($param);
    }
}

?>
