<?php

namespace App\Actions\Users;

use App\Cores\Abstracts\Action;
use App\SubActions\Users\UploadImageSubAction;
use App\Tasks\Users\CreateUserPermissionTask;
use App\Tasks\Users\CreateUserTask;
use App\Tasks\Users\FindUserByIdTask;
use Illuminate\Http\Request;

class CreateUserPermissionAction extends Action
{
    public function run(Request $request, $id)
    {
        $user = resolve(FindUserByIdTask::class)->run($id);
        $user->permissions()->sync($request->permission_id);
        return $user;
    }
}
