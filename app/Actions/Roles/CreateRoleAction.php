<?php

namespace App\Actions\Roles;

use App\Cores\Abstracts\Action;
use App\Tasks\Roles\CreateRoleTask;
use Illuminate\Http\Request;

class CreateRoleAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->all();
        unset($data['permission_id']);
        $role = resolve(CreateRoleTask::class)->run($data);
        $role->permissions()->attach($request->permission_id);
        return $role;
    }
}
