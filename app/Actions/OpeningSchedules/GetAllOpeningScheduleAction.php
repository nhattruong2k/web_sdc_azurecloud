<?php


namespace App\Actions\OpeningSchedules;

use App\Actions\CourseCategories\FindCourseCategoryByIdAction;
use App\Actions\Courses\FindCourseByIdAction;
use App\Cores\Abstracts\Action;
use App\Tasks\OpeningSchedules\GetAllOpeningScheduleTask;
use App\Tasks\Users\FindUserByIdTask;

class GetAllOpeningScheduleAction extends Action
{
    public function run(array $columns = ['*']){
        $opening_schedule =  resolve(GetAllOpeningScheduleTask::class)->run($columns);
        foreach ($opening_schedule as $value){
            $value->data = json_decode($value->data);
            foreach ($value->data as $row){
                $counselors = resolve(FindUserByIdTask::class)->run($row->counselor_id, ['id','name','phone','email']);
                $row->counselors = $counselors;
               
            }
            $course = resolve(FindCourseByIdAction::class)->run($value->courses->id);
            $course_category = resolve(FindCourseCategoryByIdAction::class)->run($course->course_category_id, ['id', 'title', 'slug']);
            $value['course_category'] = $course_category;
        }
        return $opening_schedule;
    }
}
