<?php
namespace App\Tasks\CourseCategories;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\CourseCategoriesRepository;

class CheckExistCourseCategoryTask extends Task
{
    protected $courseCategoriesRepository;
    public function __construct(CourseCategoriesRepository $courseCategoriesRepository)
    {
        $this->courseCategoriesRepository = $courseCategoriesRepository;
    }

    public function run($title, $id = null)
    {
        return $this->courseCategoriesRepository->scopeQuery(function ($query) use($title, $id) {
            $query = $query->whereTitle($title);
            if (!empty($id)) {
                $query = $query->where('id', '!=', $id);
            }
            return $query;
        })->exists();
    }
}
