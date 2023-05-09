<?php


namespace App\Tasks\Courses;
use App\Helpers\Cache;
use App\Libs\Constants;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\CourseRepository;

class GetAllCourseTask extends Task
{
    protected CourseRepository $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function run($params, array $columns = ['*'])
    {
        $courses = $this->courseRepository->active()->with('course_categories:id,title,slug')->select($columns);
        if (!empty($params['keyword'])){
            $courses->where('keyword', 'like', "%" . $params['keyword'] . "%");
        }
        if(empty(Cache::read(Constants::$fileName['course']))){
            Cache::write(Constants::$fileName['course'], $courses->get());
        }
        return $courses->get();

    }
}
