<?php


namespace App\Actions\Users;


use App\Tasks\Users\CheckExistUsernameTask;
use Illuminate\Http\Request;

class CheckExistUsernameAction
{
    public function run(Request $request){
        $username = trim($request->get("username"));
        $id = trim($request->get("id"));
        return resolve(CheckExistUsernameTask::class)->run($username, $id);
    }
}
