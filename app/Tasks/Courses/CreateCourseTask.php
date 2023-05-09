<?php

namespace App\Tasks\Courses;

use Exception;
use App\Helpers\Cache;
use App\Libs\Constants;
use App\Cores\Abstracts\Task;
use App\Exceptions\InternalErrorException;
use App\Repositories\Contracts\CourseRepository;

class CreateCourseTask extends Task
{

    protected CourseRepository $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    /**
     * @param array $data
     * @return mixed
     * @throws InternalErrorException
     */
    public function run(array $data)
    {
        try {
            $course = $this->courseRepository->create($data);
            Cache::delete(Constants::$fileName['course']);
        } catch (Exception $ex) {
            throw new InternalErrorException(__('course.create_error'));
        }
        return $course;
    }
}
