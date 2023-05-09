<?php

namespace App\Tasks\Consultations;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\ConsultationRepository;
use App\Exceptions\InternalErrorException;
use Exception;

class UpdateStatusConsultationTask extends Task
{

    protected ConsultationRepository $consultationRepository;

    public function __construct(ConsultationRepository $consultationRepository)
    {
        $this->consultationRepository = $consultationRepository;
    }

    /**
     * @param array $data
     * @return mixed
     * @throws InternalErrorException
     */
    public function run(array $data, int $consultationId)
    {
        if (empty($data)) {
            throw new InternalErrorException(__('common.inputs_empty'));
        }
        try {
            $consultation = $this->consultationRepository->update($data, $consultationId);
        } catch (Exception $ex) {
            throw new InternalErrorException(__('consultations.create_error'));
        }
        return $consultation;
    }
}
