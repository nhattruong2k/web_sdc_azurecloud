<?php


namespace App\Tasks\CourseCategories;


use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\CourseCategoriesRepository;

class GetPluckCourseCategoryTask extends Task
{
    protected $courseCategoriesRepository;
    public function __construct(CourseCategoriesRepository $courseCategoriesRepository){
        $this->courseCategoriesRepository = $courseCategoriesRepository;
    }

    public function run($id = null){
        return $this->courseCategoriesRepository->active()->removeId($id)->pluck('title', 'id');
    }
}
