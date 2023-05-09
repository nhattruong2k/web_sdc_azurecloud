<?php

namespace App\Actions\Works;

use App\Cores\Abstracts\Action;
use App\Tasks\Works\GetListWorkTask;
use Illuminate\Http\Request;

class GetListWorkAction extends Action
{
    public function run(Request $request, array $columns = ['*']){
        $params = $request->all();
        $works = resolve(GetListWorkTask::class)->run($params, $columns);
        return $works;
    }
}
