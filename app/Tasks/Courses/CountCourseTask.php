<?php


namespace App\Tasks\Courses;


use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\CourseRepository;

class CountCourseTask extends Task
{
    protected CourseRepository $courseRepository;
    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function run(){
        return $this->courseRepository->count();
    }
}
