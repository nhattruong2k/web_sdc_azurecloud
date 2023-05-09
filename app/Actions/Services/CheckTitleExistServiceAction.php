<?php

namespace App\Actions\Services;

use App\Cores\Abstracts\Action;
use App\Tasks\Services\CheckTitleExistServiceTask;
use Illuminate\Http\Request;

class CheckTitleExistServiceAction extends Action
{
    public function run(Request $request){
        $title = trim($request->get("title"));
        $id = trim($request->get("id"));
        return resolve(CheckTitleExistServiceTask::class)->run($title, $id);
    }
}
