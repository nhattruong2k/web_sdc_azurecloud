<?php

namespace App\Tasks\Courses;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\CourseRepository;
use App\Exceptions\NotFoundException;
use Exception;

class FindCourseByIdTask extends Task
{
    protected CourseRepository $courseRepository;

    public function __construct(CourseRepository $courseRepository) {
        $this->courseRepository = $courseRepository;
    }

    public function run(int $id, $columns = ['*'])
    {
        try {
            $course = $this->courseRepository->find($id, $columns);
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $course;
    }
}
