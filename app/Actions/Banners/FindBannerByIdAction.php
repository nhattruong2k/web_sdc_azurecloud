<?php

namespace App\Actions\Banners;

use App\Cores\Abstracts\Action;
use App\Tasks\Banners\FindBannerByIdTask;

class FindBannerByIdAction extends Action
{
    public function run(int  $id, array $columns = ['*'])
    {
        return resolve(FindBannerByIdTask::class)->run($id, $columns);
    }
}
