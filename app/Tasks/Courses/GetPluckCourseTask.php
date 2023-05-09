<?php
namespace App\Tasks\Courses;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\CourseRepository;

class GetPluckCourseTask extends Task
{
    protected $courseRepository;
    public function __construct(CourseRepository $courseRepository){
        $this->courseRepository = $courseRepository;
    }

    public function run(){
        return $this->courseRepository->active()->pluck('title', 'id');
    }
}
