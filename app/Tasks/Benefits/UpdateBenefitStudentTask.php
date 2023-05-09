<?php

namespace App\Tasks\Benefits;

use App\Cores\Abstracts\Task;
use App\Exceptions\NotFoundException;
use App\Exceptions\UpdateResourceFailedException;
use Exception;
use App\Exceptions\InternalErrorException;
use App\Repositories\Contracts\BenefitsRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateBenefitStudentTask extends Task
{

    protected BenefitsRepository $benefitsRepository;

    public function __construct(BenefitsRepository $benefitsRepository)
    {
        $this->benefitsRepository = $benefitsRepository;
    }

    public function run($data, int $benefitId)
    {
        if (empty($data)) {
            throw new InternalErrorException(__('common.inputs_empty'));
        }
        try {
            $benefit = $this->benefitsRepository->update($data, $benefitId);
        } catch (ModelNotFoundException $ex) {
            throw new NotFoundException(__('common.not_found'));
        } catch (Exception $ex) {
            throw new InternalErrorException(__('benefits.update_error'));
        }

        return $benefit;
    }
}
