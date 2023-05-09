<?php

namespace App\Tasks\Lookups;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\ListExamsRepository;

class GetDiplomaLookupTask extends Task
{
    protected ListExamsRepository $listExamsRepository;
    public function __construct(ListExamsRepository $listExamsRepository)
    {
        $this->listExamsRepository = $listExamsRepository;
    }
    public function run(array $params, $key, $value){
        $columns = [
            'list_exams.certificate_no',
            'regis_exams.fullname',
            'regis_exams.birthday',
            'list_exams.mark_1',
            'list_exams.mark_2',
            'list_exams.mark_3',
            'list_exams.mark_4',
            'list_exams.mark_5',
            'list_exams.mark_6',
            'list_exams.date_entered',
            'list_exams.day_exam',
            'list_exams.decide_number',
            'list_exams.decide_cn',
        ];
        $diplomas = $this->listExamsRepository->select($columns)
                    ->join('regis_exams', 'regis_exams.id', '=', 'list_exams.regis_exam_id')
                    ->where('list_exams.type', $params['type'])
                    ->where('regis_exams.fullname', 'LIKE', '%'.$params['name'].'%')
                    ->where('regis_exams.birthday', $params['ngaysinh'])
                    ->where('list_exams.check_vanbang', 2);
        if (!empty($value)){
            $diplomas->where($key, $value);
        }
        return $diplomas->get();
    }
}
