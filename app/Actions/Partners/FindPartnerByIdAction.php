<?php

namespace App\Actions\Partners;

use App\Cores\Abstracts\Action;
use App\Tasks\Partners\FindPartnerByIdTask;

class FindPartnerByIdAction extends Action
{
    public function run(int  $id, array $columns = ['*'])
    {
        return resolve(FindPartnerByIdTask::class)->run($id, $columns);
    }
}
