<?php

namespace App\Tasks\Courses;

use Exception;
use App\Helpers\Cache;
use App\Libs\Constants;
use App\Cores\Abstracts\Task;
use App\Exceptions\NotFoundException;
use App\Exceptions\InternalErrorException;
use App\Repositories\Contracts\CourseRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateCourseTask extends Task
{

    protected CourseRepository $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function run($data, int $id)
    {
        if (empty($data)) {
            throw new InternalErrorException(__('common.inputs_empty'));
        }
        try {
            $course = $this->courseRepository->update($data, $id);
            Cache::delete(Constants::$fileName['course']);
        } catch (ModelNotFoundException $ex) {
            throw new NotFoundException(__('common.not_found'));
        } catch (Exception $ex) {
            throw new InternalErrorException(__('roles.update_error'));
        }

        return $course;
    }
}
