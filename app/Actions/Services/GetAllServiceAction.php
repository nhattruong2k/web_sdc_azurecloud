<?php

namespace App\Actions\Services;

use App\Cores\Abstracts\Action;
use App\Libs\Constants;
use App\Models\Service;
use App\Tasks\Services\GetAllServiceTask;
use Illuminate\Support\Facades\Storage;

class GetAllServiceAction extends Action
{
    public function run($columns = ['*']){
        $services = resolve(GetAllServiceTask::class)->run($columns);
        foreach ($services as $service){
            $urls = json_decode($service->link);
            foreach ($urls as $url){
                $url->icon = Storage::disk(Constants::$disk)->url(Service::FOLDER_IMAGES . '/' . $url->icon);
            }
            $service->links = $urls;
            unset($service->link);
        }
        return $services;
    }
}
