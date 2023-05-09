<?php


namespace App\Actions\Category;


use App\Tasks\Category\CheckExistCategoryTask;
use Illuminate\Http\Request;

class CheckExistCategoryAction
{
    public function run(Request $request){
        $title = trim($request->get("title"));
        $id = trim($request->get("id"));
        return resolve(CheckExistCategoryTask::class)->run($title, $id);
    }
}
