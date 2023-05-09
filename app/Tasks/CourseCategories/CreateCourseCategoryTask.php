<?php
namespace App\Tasks\CourseCategories;
use App\Cores\Abstracts\Task;
use App\Exceptions\InternalErrorException;
use App\Repositories\Contracts\CourseCategoriesRepository;
use Exception;

class CreateCourseCategoryTask extends Task {
    protected CourseCategoriesRepository $courseCategoriesRepository;
    public function __construct(CourseCategoriesRepository $courseCategoriesRepository)
    {
        $this->courseCategoriesRepository = $courseCategoriesRepository;
    }

    public function run(array $data)
    {
        try {
            $course_categories = $this->courseCategoriesRepository->create($data);
        } catch (Exception $ex) {
            throw new InternalErrorException(__('course_categories.create_error'));
        }
        return $course_categories;
    }
}
?>
