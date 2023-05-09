<?php

namespace App\Tasks\Courses;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\CourseRepository;

class GetPagingCourseTask extends Task
{

    protected CourseRepository $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function run(array $param, array $columns = ['*'])
    {
        $columns = [
            'courses.id',
            'courses.title',
            'courses.slug',
            'courses.image',
            'courses.time',
            'courses.degree',
            'courses.object',
            'courses.course_category_id',
            'courses.description',
            'courses.content',
            'courses.status',
            'courses.keyword',
        ];

        $courses = $this->courseRepository->scopeQuery(function ($query) use ($param) {
            if ((isset($param['search']) && $param['search'])) {
                $query->where('courses.title', 'like', "%" . $param['search'] . "%");
            }

            if((isset($param['category_course']) && $param['category_course'])){
                $query->where('courses.course_category_id', $param['category_course'])->where('courses.title', 'like', "%" . $param['search'] . "%");
            }

            if (!empty($param['status'])) {
                $query->where('courses.status', $param['status']);
            }
            return $query;
        });
        $courses->orderBy($param['sortfield'], $param['sorttype']);
        return $courses->paginate($param['limit'], $columns);
    }
}
