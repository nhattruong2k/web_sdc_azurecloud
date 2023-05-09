<?php
namespace App\Actions\TeamTeachers;
use App\Cores\Abstracts\Action;
use App\Tasks\TeamTeachers\FindTeachersBySlugTask;

class FindTeachersBySlugAction extends Action {
    public function run($slug)
    {
        $teachers = resolve(FindTeachersBySlugTask::class)->run($slug);
        return $teachers;
    }
}

?>
