<?php

namespace App\Actions\Config;

use App\Cores\Abstracts\Action;
use App\Tasks\Config\FindConfigByIdTask;
use App\Tasks\Config\UpdateConfigTask;
use Illuminate\Http\Request;

class UpdateConfigAction extends Action
{
    public function run(int $id, Request $request)
    {
        $config = resolve(FindConfigByIdTask::class)->run($id);
        $data = $request->all();
        $data['status'] = isset($data['status']) ? 1 : 0;
        return resolve(UpdateConfigTask::class)->run($data, $config->id);
    }
}
