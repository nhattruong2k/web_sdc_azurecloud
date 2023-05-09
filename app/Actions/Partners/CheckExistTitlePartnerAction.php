<?php


namespace App\Actions\Partners;

use App\Tasks\Partners\CheckExistTitlePartnerTask;
use Illuminate\Http\Request;

class CheckExistTitlePartnerAction
{
    public function run(Request $request){
        $key = trim($request->get("title"));
        $id = trim($request->get("id"));
        return resolve(CheckExistTitlePartnerTask::class)->run($key, $id);
    }
}
