<?php

namespace App\Actions\Consultations;

use App\Cores\Abstracts\Action;
use App\Tasks\Consultations\GetPagingConsultationTask;

class GetPagingConsultationAction extends Action
{

    public function run(array $param)
    {
        if(!empty( $param['fromDate'])) {
            $param['fromDate'] = formatDate($param['fromDate'], 'Y-m-d 00:00:00');
        }
        if(!empty( $param['toDate'])) {
            $param['toDate'] = formatDate($param['toDate'], 'Y-m-d 23:59:59');
        }
        return resolve(GetPagingConsultationTask::class)->run($param);
    }
}
