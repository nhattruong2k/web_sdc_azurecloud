<?php

namespace App\Tasks\Courses;

use Exception;
use App\Helpers\Cache;
use App\Libs\Constants;
use App\Cores\Abstracts\Task;
use App\Exceptions\InternalErrorException;
use App\Repositories\Contracts\CourseRepository;

class GetAllCourseByCategoryTask extends Task
{

    protected CourseRepository $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function run($course_categories, $param, array $columns = ['*'])
    {
        $courses = array();
        foreach ($course_categories as $course_category) {
            $listCourses = $course_category->courses($columns)->active()->orderBy($param['sortfield'], $param['sorttype'])->get();
            $course_category['courses'] = $listCourses;
            $courses[] = $course_category;
        }
        
        return $courses;
    }
}
