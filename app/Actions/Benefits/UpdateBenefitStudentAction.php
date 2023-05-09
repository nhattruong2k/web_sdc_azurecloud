<?php

namespace App\Actions\Benefits;

use App\Cores\Abstracts\Action;
use App\Models\Benefit;
use App\SubActions\Common\UploadImageSubAction;
use App\Tasks\Benefits\FindBenefitStudentByIdTask;
use App\Tasks\Benefits\UpdateBenefitStudentTask;
use Illuminate\Http\Request;

class UpdateBenefitStudentAction extends Action
{
    public function run(int $id, Request $request)
    {
        $benefit = resolve(FindBenefitStudentByIdTask::class)->run($id);
        $data = $request->all();
        $data['status'] = isset($data['status']) ? 1 : 0;
        if ($request->hasFile('image')){
            $this->handleUploadImage($request->file('image'), $data);
        }
        if ($request->hasFile('icon')){
            $this->handleUploadIcon($request->file('icon'), $data);
        }
        $benefit = resolve(UpdateBenefitStudentTask::class)->run($data, $id);
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
