<?php


namespace App\Actions\Roles;


use App\Cores\Abstracts\Action;
use App\Tasks\Roles\CheckExistRoleNameTask;
use Illuminate\Http\Request;

class CheckExistRoleNameAction extends Action
{
    public function run(Request $request){
        $name = trim($request->get("name"));
        $id = trim($request->get("id"));
        return resolve(CheckExistRoleNameTask::class)->run($name, $id);
    }
}
