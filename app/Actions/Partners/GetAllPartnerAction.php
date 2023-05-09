<?php


namespace App\Actions\Partners;


use App\Cores\Abstracts\Action;
use App\Tasks\Partners\GetAllPartnerTask;

class GetAllPartnerAction extends Action
{
    public function run($column = ['*']){
        return resolve(GetAllPartnerTask::class)->run($column);
    }
}
