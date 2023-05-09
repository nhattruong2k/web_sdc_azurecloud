<?php

namespace App\Actions\FeelStudents;

use App\Cores\Abstracts\Action;
use App\Models\FeelStudent;
use App\SubActions\Common\UploadImageSubAction;
use App\Tasks\FeelStudents\CreateFeelStudentTask;
use Illuminate\Http\Request;

class CreateFeelStudentAction extends Action
{
    public function run (Request $request)
    {
        $data = $request->all();
        if($request->hasFile('avatar')){
            $this->handleUploadAvatar($request->file('avatar'), $data);
        }

        return resolve(CreateFeelStudentTask::class)->run($data);
    }
    private function handleUploadAvatar($file, array &$data)
    {
        $filename = resolve(UploadImageSubAction::class)->run($file, $data['name'], FeelStudent::FOLDER_IMAGES);
        if(!empty($filename)) {
            $data['avatar'] = $filename;
        }
    }
}
