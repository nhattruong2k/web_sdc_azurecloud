<?php


namespace App\Actions\Users;


use App\Cores\Abstracts\Action;
use App\Models\User;
use App\Tasks\Commons\DestroyImageTask;
use App\Tasks\Users\FindUserByIdTask;
use App\Tasks\Users\UpdateUserTask;

class DestroyUserImageAction extends Action
{
    public function run($id, $imageName){
        resolve(FindUserByIdTask::class)->run($id);
        $data['avatar'] = '';
        $pathFolder = sprintf(User::FOLDER_IMAGES);
        resolve(DestroyImageTask::class)->run($pathFolder . '/' . $imageName);
        resolve(UpdateUserTask::class)->run($data, $id);
        return true;
    }
}
