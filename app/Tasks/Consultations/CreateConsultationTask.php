<?php

namespace App\Tasks\Consultations;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\ConsultationRepository;
use App\Exceptions\InternalErrorException;
use Exception;
use App\Helpers\Email;

class CreateConsultationTask extends Task
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
    public function run(array $data)
    {
        try {
            $consultation = $this->consultationRepository->create($data);
            Email::sendEmailConsultation($data);
        } catch (Exception $ex) {
            throw new InternalErrorException(__('consultations.create_error'));
        }
        return $consultation;
    }
}
