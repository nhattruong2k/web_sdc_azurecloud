<?php

namespace App\Tasks\Benefits;

use App\Cores\Abstracts\Task;
use App\Exceptions\NotFoundException;
use App\Repositories\Contracts\BenefitsRepository;
use Exception;

class FindBenefitStudentByIdTask extends Task
{
    protected BenefitsRepository $benefitsRepository;

    public function __construct(BenefitsRepository $benefitsRepository) {
        $this->benefitsRepository = $benefitsRepository;
    }

    public function run(int $id, $columns = ['*'])
    {
        try {
            $benefitStudent = $this->benefitsRepository->find($id, $columns);
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $benefitStudent;
    }
}
