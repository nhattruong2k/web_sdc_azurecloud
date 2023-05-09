<?php

namespace App\Tasks\Benefits;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\BenefitsRepository;

class GetPagingBenefitStudentTask extends Task
{
    protected BenefitsRepository $benefitsRepository;

    public function __construct(BenefitsRepository $benefitsRepository)
    {
        $this->benefitsRepository = $benefitsRepository;
    }

    public function run(array $param, array $columns = ['*'])
    {
        $columns = [
            'benefit_students.id',
            'benefit_students.title',
            'benefit_students.image',
            'benefit_students.status',
            'benefit_students.icon',
        ];
        $benefitStudents = $this->benefitsRepository->scopeQuery(function ($q) use ($param){
            if (isset($param['search']) && $param['search']){
                $q->where('benefit_students.title', 'like', "%" . $param['search'] . "%");
            }
            return $q;
        });
        $benefitStudents->orderBy($param['sortfield'], $param['sorttype']);
   
        return $benefitStudents->paginate($param['limit'], $columns);
    }
}