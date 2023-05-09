<?php


namespace App\Tasks\Courses;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\CourseRepository;

class GetRelateCourseTask extends Task
{
    protected CourseRepository $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function run(int $id_cate, int $id, array $columns = ['*'])
    {
        return $this->courseRepository->active()->with('course_categories:id,title')->where('course_category_id', $id_cate)->where('id', '<>', $id)->select($columns)->get();
    }
}
