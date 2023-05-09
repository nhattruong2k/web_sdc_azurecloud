<?php
namespace  App\Actions\CourseCategories;

use App\Cores\Abstracts\Action;
use App\Tasks\CourseCategories\FindCourseCategoryByIdTask;

class FindCourseCategoryByIdAction extends Action{

    public function run(int  $id, array $columns = ['*'])
    {
        return resolve(FindCourseCategoryByIdTask::class)->run($id, $columns);
    }
}

?>
