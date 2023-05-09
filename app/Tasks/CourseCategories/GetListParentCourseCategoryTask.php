<?php
namespace App\Tasks\CourseCategories;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\CourseCategoriesRepository;

class GetListParentCourseCategoryTask extends Task {

    protected $courseCategoriesRepository;
    public function __construct(CourseCategoriesRepository $courseCategoriesRepository)
    {
        $this->courseCategoriesRepository = $courseCategoriesRepository;
    }

    public function run($id = null, array $columns = ['*'])
    {
        return $this->courseCategoriesRepository->active()->removeId($id)->select($columns)->get();
    }
}

?>
