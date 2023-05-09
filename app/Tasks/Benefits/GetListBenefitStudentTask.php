<?php


namespace App\Tasks\Benefits;


use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\BenefitsRepository;

class GetListBenefitStudentTask extends Task
{
    
    protected $benefitsRepository;

    public function __construct(BenefitsRepository $benefitsRepository)
    {
        $this->benefitsRepository = $benefitsRepository;
    }

    public function run($column = ['*']){
        $benefits = $this->benefitsRepository->active()->get($column);
        return $benefits;
    }
}
