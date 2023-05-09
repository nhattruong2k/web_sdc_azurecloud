<?php

namespace App\Actions\Projectstudents;

use App\Cores\Abstracts\Action;
use App\Models\ProjectStudent;
use App\SubActions\Common\UploadImageSubAction;
use App\Tasks\Projectstudents\FindProjectStudentByIdTask;
use App\Tasks\Projectstudents\UpdateProjectStudentTask;
use Illuminate\Http\Request;

class UpdateProjectStudentAction extends Action
{
    public function run(int $id, Request $request)
    {
        $projectStudent = resolve(FindProjectStudentByIdTask::class)->run($id);
        $data = $request->all();
        $data['status'] = isset($data['status']) ? 1 : 0;
        if ($request->hasFile('image')){
            $this->handleUploadImage($request->file('image'), $data);
        }
        $projectStudent = resolve(UpdateProjectStudentTask::class)->run($data, $id);
        return $projectStudent;
    }

    private function handleUploadImage($file, array &$data)
    {
        $filename = resolve(UploadImageSubAction::class)->run($file, $data['title'], ProjectStudent::FOLDER_IMAGES);
        if(!empty($filename)) {
            $data['image'] = $filename;
        }
    }
}
