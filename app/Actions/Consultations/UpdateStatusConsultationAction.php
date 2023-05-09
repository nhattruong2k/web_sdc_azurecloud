<?php

namespace App\Actions\Consultations;

use App\Cores\Abstracts\Action;
use App\Tasks\Consultations\UpdateStatusConsultationTask;

class UpdateStatusConsultationAction extends Action
{
    public function run($request){
        $find_id = resolve(FindConsultationByIdAction::class)->run($request->get('id'));
        $data = $request->all();
        $data['reason'] = !empty($data['reason']) ? $data['reason'] : null;
        $consultation = resolve(UpdateStatusConsultationTask::class)->run($data, $find_id->id);
        return $consultation;
    }
}
