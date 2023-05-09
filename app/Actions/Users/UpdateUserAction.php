<?php

namespace App\Actions\Users;

use App\Cores\Abstracts\Action;
use App\Models\User;
use App\SubActions\Common\UploadImageSubAction;
use App\Tasks\Users\FindUserByIdTask;
use App\Tasks\Users\UpdateUserTask;
use Illuminate\Http\Request;

class UpdateUserAction extends Action
{
    public function run(int $id, Request $request)
    {
        $user = resolve(FindUserByIdTask::class)->run($id);
        $data = $request->all();
        if ($request->hasFile('avatar')){
            $this->handleUploadAvatar($request->file('avatar'), $data);
        }else{
            if ($data['remove_img'] == true){
                $data['avatar'] = '';
            }
        }
        $data['is_visible'] = !empty($data['is_visible']) ? $data['is_visible'] : 0;
        $user = resolve(UpdateUserTask::class)->run($data, $user->id);
        if ($request->role_id){
            $user->roles()->sync($request->role_id);
        }
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
