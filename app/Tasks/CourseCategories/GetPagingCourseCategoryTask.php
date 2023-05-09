<?php

namespace App\Tasks\CourseCategories;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\CourseCategoriesRepository;

class GetPagingCourseCategoryTask extends Task
{

    protected $courseCategoriesRepository;
    public function __construct(CourseCategoriesRepository $courseCategoriesRepository)
    {
        $this->courseCategoriesRepository = $courseCategoriesRepository;
    }

    public function run(array $param, array $columns = ['*'])
    {

        $columns = [
            'course_categories.id',
            'course_categories.title',
            'course_categories.slug',
            'course_categories.summary',
            'course_categories.parent_id',
            'course_categories.image',
            'course_categories.order',
            'course_categories.status',
        ];
        $categories = $this->courseCategoriesRepository->scopeQuery(function ($query) use ($param) {
            if ((isset($param['search']) && $param['search'])) {
                $query->where('course_categories.title', 'like', "%" . $param['search'] . "%");
            }

            if (!empty($param['status'])) {
                $query->where('course_categories.status', $param['status']);
            }
            return $query;
        });
        $categories->orderBy($param['sortfield'], $param['sorttype']);
        return $categories->paginate($param['limit'], $columns);
    }
}
