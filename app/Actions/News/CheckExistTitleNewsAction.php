<?php


namespace App\Actions\News;


use App\Tasks\News\CheckExistTitleNewsTask;
use Illuminate\Http\Request;

class CheckExistTitleNewsAction
{
    public function run(Request $request){
        $title = trim($request->get("title"));
        $id = trim($request->get("id"));
        return resolve(CheckExistTitleNewsTask::class)->run($title, $id);
    }
}

?>