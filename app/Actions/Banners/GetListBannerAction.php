<?php

namespace App\Actions\Banners;

use App\Cores\Abstracts\Action;
use App\Tasks\Banners\GetListBannerTask;

class GetListBannerAction extends Action
{
    public function run(array $param)
    {
        return resolve(GetListBannerTask::class)->run($param);
    }
}