<?php
namespace App\Actions\Consultations;

use App\Cores\Abstracts\Action;
use App\Tasks\Consultations\FindConsultationByFieldTask;

class FindConsultationByIdAction extends Action
{
    public function run(int  $id, array $columns = ['*']){
        return resolve(FindConsultationByFieldTask::class)->run($id, $columns);
    }
}
?>