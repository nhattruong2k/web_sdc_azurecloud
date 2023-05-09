<?php

namespace App\Actions\Consultations;

use App\Cores\Abstracts\Action;
use App\Tasks\Consultations\CountConsultationTask;

class CountConsultationAction extends Action
{
    public function run(){
        return resolve(CountConsultationTask::class)->run();
    }
}
