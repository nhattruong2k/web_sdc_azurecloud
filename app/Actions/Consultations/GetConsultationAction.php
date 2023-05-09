<?php

namespace App\Actions\Consultations;

use Illuminate\Http\Request;
use App\Cores\Abstracts\Action;
use App\Tasks\Consultations\GetConsultationTask;

class GetConsultationAction extends Action
{
    public function run(Request $request)
    {
        $email = $request->get('email');
        $course = $request->get('course_id');
        $consultation = resolve(GetConsultationTask::class)->run($email, $course);
        return $consultation;
    }
}
