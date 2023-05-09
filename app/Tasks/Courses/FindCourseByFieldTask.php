<?php
namespace App\Tasks\Courses;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\CourseRepository;

class FindCourseByFieldTask extends Task
{
    protected $courseRepository;
    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function run($field, $value){
        return $this->courseRepository->scopeQuery(function ($query) use($field, $value) {
            $query = $query->where($field, $value);
            return $query;
        })->exists();
    }
}
