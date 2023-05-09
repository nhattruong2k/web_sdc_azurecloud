<?php


namespace App\Actions\Menus;

use App\Tasks\Menus\CheckExistTitleMenuTask;
use Illuminate\Http\Request;

class CheckExistTitleMenuAction
{
    public function run(Request $request){
        $title = trim($request->get("title"));
        $id = trim($request->get("id"));
        return resolve(CheckExistTitleMenuTask::class)->run($title, $id);
    }
}
