<?php


namespace App\Actions\Config;

use App\Tasks\Config\CheckExistKeyConfigTask;
use Illuminate\Http\Request;

class CheckExistKeyConfigAction
{
    public function run(Request $request){
        $key = trim($request->get("key"));
        $id = trim($request->get("id"));
        return resolve(CheckExistKeyConfigTask::class)->run($key, $id);
    }
}
