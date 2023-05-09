<?php


namespace App\Actions\Users;


use App\Tasks\Users\CheckExistEmailTask;
use Illuminate\Http\Request;

class CheckExistEmailAction
{
    public function run(Request $request){
        $email = trim($request->get("email"));
        $id = trim($request->get("id"));
        return resolve(CheckExistEmailTask::class)->run($email, $id);
    }
}
