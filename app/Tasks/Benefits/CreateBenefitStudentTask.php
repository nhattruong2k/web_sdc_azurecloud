<?php

namespace App\Tasks\Benefits;

use App\Cores\Abstracts\Task;
use App\Exceptions\InternalErrorException;
use App\Repositories\Contracts\BenefitsRepository;
use Exception;

class CreateBenefitStudentTask extends Task
{

    public BenefitsRepository $benefitsRepository;
    public function __construct(BenefitsRepository $benefitsRepository)
    {
        $this->benefitsRepository = $benefitsRepository;
    }
    public function run(array $data)
    {
        try {
            $benefit = $this->benefitsRepository->create($data);    
        } catch (Exception $ex) {
            throw new InternalErrorException(__('benefits.create_error'));   
        }
        return $benefit;
    }
}
