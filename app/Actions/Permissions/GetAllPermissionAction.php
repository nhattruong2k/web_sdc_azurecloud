<?php


namespace App\Actions\Permissions;


use App\Tasks\Permissions\GetAllPermissionTask;

class GetAllPermissionAction
{
    public function run(){
        return resolve(GetAllPermissionTask::class)->run();
    }
}
