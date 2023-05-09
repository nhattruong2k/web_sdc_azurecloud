<?php


namespace App\Actions\Benefits;

use App\Cores\Abstracts\Action;
use App\Models\Benefit;
use App\Tasks\Benefits\FindBenefitStudentByIdTask;
use App\Tasks\Benefits\UpdateBenefitStudentTask;
use App\Tasks\Commons\DestroyImageTask;

class DestroyImageBenefitsAction extends Action
{
    public function run($id, $imageName, $type){
        resolve(FindBenefitStudentByIdTask::class)->run($id);
        $data[$type] = '';
        $pathFolder = sprintf(Benefit::FOLDER_IMAGES);
        resolve(DestroyImageTask::class)->run($pathFolder . '/' . $imageName);
        resolve(UpdateBenefitStudentTask::class)->run($data, $id);
        return true;
    }
}
