<?php

namespace App\Tasks\Lookups;

use App\Cores\Abstracts\Task;
use App\Libs\Constants;
use App\Repositories\Contracts\ListExamsRepository;

class GetPointLookupTask extends Task
{
    protected ListExamsRepository $listExamsRepository;
    public function __construct(ListExamsRepository $listExamsRepository)
    {
        $this->listExamsRepository = $listExamsRepository;
    }
    public function run(array $params, $key){
        $columns = [
            'list_exams.mahocvien',
            'regis_exams.fullname',
            'regis_exams.birthday',
            'list_exams.mark_1',
            'list_exams.mark_2',
            'list_exams.mark_3',
            'list_exams.mark_4',
            'list_exams.mark_5',
            'list_exams.mark_6',
            'list_exams.rating_type',
            'list_exams.day_exam',
            'list_exams.decide_number',
        ];
      
        $points = $this->listExamsRepository->select($columns)
            ->join('regis_exams', 'regis_exams.id', '=', 'list_exams.regis_exam_id')
            ->where('list_exams.type', $params['type'])
            ->whereNotNull('list_exams.day_exam');
        if ($params['key'] == Constants::$typeLookupPoint['hoten']){
            $points->where($key, 'LIKE', '%'.$params['value'].'%');
        }elseif ($params['key'] == Constants::$typeLookupPoint['mahocvien']){
            $points->where('list_exams.mahocvien', $params['value']);
        }else{
            $points->where($key, $params['value']);
        }
        
        return $points->get();
    }
}
