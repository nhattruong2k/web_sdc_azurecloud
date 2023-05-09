<?php

namespace App\Actions\FeelStudents;

use App\Cores\Abstracts\Action;
use App\Models\FeelStudent;
use App\SubActions\Common\UploadImageSubAction;
use App\Tasks\FeelStudents\FindFeelStudentByIdTask;
use App\Tasks\FeelStudents\UpdateFeelStudentTask;
use Illuminate\Http\Request;

class UpdateFeelStudentAction extends Action
{
    public function run(int $id, Request $request)
    {
        $feelStudent = resolve(FindFeelStudentByIdTask::class)->run($id);
        $data = $request->all();
        $data['status'] = isset($data['status']) ? 1 :0;
        if ($request->hasFile('avatar')){
            $this->handleUploadAvatar($request->file('avatar'), $data);
        }
        $feelStudent = resolve(UpdateFeelStudentTask::class)->run($data, $id);
        return $feelStudent;
    }

    private function handleUploadAvatar($file, array &$data)
    {
        $filename = resolve(UploadImageSubAction::class)->run($file, $data['name'], FeelStudent::FOLDER_IMAGES);
        if(!empty($filename)) {
            $data['avatar'] = $filename;
        }
    }
}
