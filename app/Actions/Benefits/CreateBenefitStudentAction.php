<?php

namespace App\Actions\Benefits;

use App\Cores\Abstracts\Action;
use App\Models\Benefit;
use App\SubActions\Common\UploadImageSubAction;
use App\Tasks\Benefits\CreateBenefitStudentTask;
use Illuminate\Http\Request;

class CreateBenefitStudentAction extends Action
{
    public function run (Request $request)
    {
        $data = $request->all();
        if($request->hasFile('image')){
            $this->handleUploadImage($request->file('image'), $data);
        }
        if($request->hasFile('icon')){
            $this->handleUploadIcon($request->file('icon'), $data);
        }
        $benefit = resolve(CreateBenefitStudentTask::class)->run($data);
        return $benefit;
    }
    private function handleUploadImage($file, array &$data)
    {
        $filename = resolve(UploadImageSubAction::class)->run($file, $data['title'], Benefit::FOLDER_IMAGES);
        if(!empty($filename)) {
            $data['image'] = $filename;
        }
    }
    private function handleUploadIcon($file, array &$data)
    {
        $filename = resolve(UploadImageSubAction::class)->run($file, $data['title'], Benefit::FOLDER_IMAGES);
        if(!empty($filename)) {
            $data['icon'] = $filename;
        }
    }
}
