<?php


namespace App\Actions\Banners;


use App\Cores\Abstracts\Action;
use App\Models\Banners;
use App\Tasks\Banners\FindBannerByIdTask;
use App\Tasks\Banners\UpdateBannerTask;
use App\Tasks\Commons\DestroyImageTask;

class DestroyBannerImageAction extends Action
{
    public function run($id, $imageName){
        resolve(FindBannerByIdTask::class)->run($id);
        $data['link'] = '';
        $pathFolder = sprintf(Banners::FOLDER_IMAGES);
        resolve(DestroyImageTask::class)->run($pathFolder . '/' . $imageName);
        resolve(UpdateBannerTask::class)->run($data, $id);
        return true;
    }
}
