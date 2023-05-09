<?php
namespace App\Actions\TeamStudents;
use App\Cores\Abstracts\Action;
use App\Tasks\TeamStudents\FindStudentsBySlugTask;

class FindStudentsBySlugAction extends Action {
    public function run($slug)
    {
        $students = resolve(FindStudentsBySlugTask::class)->run($slug);
        return $students;
    }
}

?>
