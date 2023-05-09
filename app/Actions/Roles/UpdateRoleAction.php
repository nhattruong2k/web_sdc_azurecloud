<?php

namespace App\Actions\Roles;

use App\Cores\Abstracts\Action;
use App\Tasks\Roles\FindRoleByIdTask;
use App\Tasks\Roles\UpdateRoleTask;
use Illuminate\Http\Request;

class UpdateRoleAction extends Action
{
    public function run(int $id, Request $request)
    {
        $role = resolve(FindRoleByIdTask::class)->run($id);
        $data = $request->all();
        $data['is_visible'] = !empty($data['is_visible']) ? $data['is_visible'] : 0;
        $role = resolve(UpdateRoleTask::class)->run($data, $role->id);
        $role->permissions()->sync($request->permission_id);
        return $role;
    }
}
