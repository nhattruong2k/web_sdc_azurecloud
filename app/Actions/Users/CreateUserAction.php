<?php

namespace App\Actions\Users;

use App\Cores\Abstracts\Action;
use App\Models\User;
use App\SubActions\Common\UploadImageSubAction;
use App\Tasks\Users\CreateUserTask;
use Illuminate\Http\Request;

class CreateUserAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->all();
        unset($data['role_id']);
        if ($request->hasFile('avatar')){
            $this->handleUploadAvatar($request->file('avatar'), $data);
        }
        $data['password'] = bcrypt($data['password']);
        $user = resolve(CreateUserTask::class)->run($data);
        $user->roles()->attach($request->role_id);
        return $user;
    }

    private function handleUploadAvatar($file, array &$data)
    {
        $filename = resolve(UploadImageSubAction::class)->run($file, $data['name'], User::FOLDER_IMAGES);
        if(!empty($filename)) {
            $data['avatar'] = $filename;
        }
    }
}
