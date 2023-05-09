<?php


namespace App\Tasks\Courses;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\CourseRepository;


class CheckTitleExistCourseTask extends Task
{
    protected CourseRepository $courseRepository;

    public function __construct(CourseRepository $courseRepository) {
        $this->courseRepository = $courseRepository;
    }

    public function run($title, $id = null)
    {
        return $this->courseRepository->scopeQuery(function ($query) use($title, $id) {
            $query = $query->whereTitle($title);
            if (!empty($id)) {
                $query = $query->where('id', '!=', $id);
            }
            return $query;
        })->exists();
    }
}
