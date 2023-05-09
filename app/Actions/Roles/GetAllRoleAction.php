<?php


namespace App\Actions\Roles;

use App\Tasks\Roles\GetAllRoleTask;

class GetAllRoleAction
{
    public function run(array $columns = ['*']){
        return resolve(GetAllRoleTask::class)->run($columns);
    }
}
