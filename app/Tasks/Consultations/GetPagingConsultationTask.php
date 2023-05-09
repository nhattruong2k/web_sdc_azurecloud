<?php

namespace App\Tasks\Consultations;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\ConsultationRepository;

class GetPagingConsultationTask extends Task
{

    protected ConsultationRepository $consultationRepository;

    public function __construct(ConsultationRepository $consultationRepository)
    {
        $this->consultationRepository = $consultationRepository;
    }

    public function run(array $param, array $columns = ['*'])
    {
        $columns = [
            'consultations.id',
            'consultations.name',
            'consultations.email',
            'consultations.phone',
            'consultations.address',
            'consultations.year_of_birth',
            'consultations.status',
            'consultations.reason',
            'consultations.course_id',
            'consultations.created_at',
        ];

        $consultations = $this->consultationRepository->scopeQuery(function ($query) use ($param) {
            
            if (!empty($param['course'])) {
                $query->where('consultations.course_id', $param['course']);
            }
            if(!empty($param['course']) && !empty($param['search'])){
                $query->where('consultations.course_id', $param['course'])->where('consultations.name', 'like', "%" . $param['search'] . "%");
            }else{
                if((isset($param['search']) && $param['search'])){
                    $query->where('consultations.name', 'like', "%" . $param['search'] . "%")
                            ->orWhere('consultations.email', 'like', "%" . $param['search'] . "%")
                            ->orWhere('consultations.phone', 'like', "%" . $param['search'] . "%");
                }    
            }

            if (!empty($param['status'])) {
                $query->where('consultations.status', $param['status']);
            }

            if(!empty($param['fromDate']) && !empty($param['toDate'])){
                $query->whereBetween('consultations.created_at', [$param['fromDate'], $param['toDate']]);
            }

            if(empty($param['toDate']) && !empty($param['fromDate'])){
                $query->where('consultations.created_at','>=',$param['fromDate']);
            }
            return $query;
        });
        $consultations->orderBy($param['sortfield'], $param['sorttype']);
        return $consultations->paginate($param['limit'], $columns);
    }
}
