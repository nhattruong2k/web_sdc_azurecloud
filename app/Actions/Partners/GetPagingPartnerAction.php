<?php

namespace App\Actions\Partners;

use App\Cores\Abstracts\Action;
use App\Tasks\Partners\GetPagingPartnerTask;

class GetPagingPartnerAction extends Action
{
    public function run(array $param)
    {
        return resolve(GetPagingPartnerTask::class)->run($param);
    }
}