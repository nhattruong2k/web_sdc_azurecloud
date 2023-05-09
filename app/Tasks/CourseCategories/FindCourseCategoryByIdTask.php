<?php
namespace App\Tasks\CourseCategories;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\CourseCategoriesRepository;
use Exception;
use App\Exceptions\NotFoundException;

class FindCourseCategoryByIdTask extends Task{
    protected $courseCategoriesRepository;

    public function __construct(CourseCategoriesRepository $courseCategoriesRepository)
    {
        $this->courseCategoriesRepository = $courseCategoriesRepository;
    }


    public function run(int $id, $columns = ['*'])
    {
        try {
            $course_category = $this->courseCategoriesRepository->find($id, $columns);
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $course_category;
    }
}
?>
