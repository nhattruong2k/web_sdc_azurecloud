<?php


namespace App\Actions\CourseCategories;


use App\Cores\Abstracts\Action;
use App\Tasks\CourseCategories\CheckExistCourseCategoryTask;
use Illuminate\Http\Request;

class CheckExistCourseCategoryAction extends Action
{
    public function run(Request $request){
        $title = trim($request->get("title"));
        $id = trim($request->get("id"));
        return resolve(CheckExistCourseCategoryTask::class)->run($title, $id);
    }
}
