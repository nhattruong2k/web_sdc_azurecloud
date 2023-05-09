<?php


namespace App\Actions\Partners;


use App\Cores\Abstracts\Action;
use App\Tasks\Partners\CountPartnerTask;

class CountPartnerAction extends Action
{
    public function run(){
        return resolve(CountPartnerTask::class)->run();
    }
}
