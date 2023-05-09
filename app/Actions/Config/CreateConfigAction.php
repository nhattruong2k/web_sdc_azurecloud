<?php

namespace App\Actions\Config;

use App\Cores\Abstracts\Action;
use App\Tasks\Config\CreateConfigTask;
use Illuminate\Http\Request;

class CreateConfigAction extends Action
{
    public function run (Request $request)
    {
        $data = $request->all();
        $config = resolve(CreateConfigTask::class)->run($data);
        return $config;
    }
}