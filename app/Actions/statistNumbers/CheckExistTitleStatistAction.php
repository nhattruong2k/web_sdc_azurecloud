<?php


namespace App\Actions\statistNumbers;


use App\Tasks\StatistNumbers\CheckExistTitleStatistTask;
use Illuminate\Http\Request;

class CheckExistTitleStatistAction
{
    public function run(Request $request){
        $title = trim($request->get("title"));
        $id = trim($request->get("id"));
        return resolve(CheckExistTitleStatistTask::class)->run($title, $id);
    }
}

?>