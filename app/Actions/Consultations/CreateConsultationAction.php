<?php

namespace App\Actions\Consultations;

use App\Cores\Abstracts\Action;
use App\Tasks\Consultations\CreateConsultationTask;
use Illuminate\Http\Request;

class CreateConsultationAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->all();
        $consultation = resolve(CreateConsultationTask::class)->run($data);
        return $consultation;
    }
}
