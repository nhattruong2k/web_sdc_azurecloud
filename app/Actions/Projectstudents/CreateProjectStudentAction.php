<?php

namespace App\Actions\Projectstudents;

use App\Cores\Abstracts\Action;
use App\Models\ProjectStudent;
use App\SubActions\Common\UploadImageSubAction;
use App\Tasks\Projectstudents\CreateProjectStudentTask;
use Illuminate\Http\Request;

class CreateProjectStudentAction extends Action
{
    public function run (Request $request)
    {
        $data = $request->all();
        if($request->hasFile('image')){
            $this->handleUploadImage($request->file('image'), $data);
        }
        $projectStudent = resolve(CreateProjectStudentTask::class)->run($data);
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
