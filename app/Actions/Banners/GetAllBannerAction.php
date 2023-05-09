<?php


namespace App\Actions\Banners;


use App\Cores\Abstracts\Action;
use App\Tasks\Banners\GetAllBannerTask;

class GetAllBannerAction extends Action
{
    public function run($column = ['*']){
        return resolve(GetAllBannerTask::class)->run($column);
    }
}
