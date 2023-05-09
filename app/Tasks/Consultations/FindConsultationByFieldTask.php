<?php

namespace App\Tasks\Consultations;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\ConsultationRepository;
use Exception;
use App\Exceptions\NotFoundException;

class FindConsultationByFieldTask extends Task
{
    protected ConsultationRepository $consultationRepository;

    public function __construct(ConsultationRepository $consultationRepository)
    {
        $this->consultationRepository = $consultationRepository;
    }

    public function run(int $id, $columns = ['*'])
    {
        try {
            $consultation = $this->consultationRepository->find($id, $columns);
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $consultation;
    }
}
