<?php

namespace App\Tasks\Consultations;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\ConsultationRepository;

class CountConsultationTask extends Task
{
    protected ConsultationRepository $consultationRepository;

    public function __construct(ConsultationRepository $consultationRepository)
    {
        $this->consultationRepository = $consultationRepository;
    }

    public function run(){
        return $this->consultationRepository->count();
    }
}
