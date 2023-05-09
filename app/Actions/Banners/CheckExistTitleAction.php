<?php


namespace App\Actions\Banners;

use App\Tasks\Banners\CheckExistTitleTask;
use Illuminate\Http\Request;

class CheckExistTitleAction
{
    public function run(Request $request){
        $title = trim($request->get("title"));
        $id = trim($request->get("id"));
        return resolve(CheckExistTitleTask::class)->run($title, $id);
    }
}
