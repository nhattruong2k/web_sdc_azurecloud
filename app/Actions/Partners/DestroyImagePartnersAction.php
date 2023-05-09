<?php


namespace App\Actions\Partners;

use App\Cores\Abstracts\Action;
use App\Models\Partners;
use App\Tasks\Commons\DestroyImageTask;
use App\Tasks\Partners\FindPartnerByIdTask;
use App\Tasks\Partners\UpdatePartnerTask;

class DestroyImagePartnersAction extends Action
{
    public function run($id, $imageName){
        resolve(FindPartnerByIdTask::class)->run($id);
        $data['image'] = '';
        $pathFolder = sprintf(Partners::FOLDER_IMAGES);
        resolve(DestroyImageTask::class)->run($pathFolder . '/' . $imageName);
        resolve(UpdatePartnerTask::class)->run($data, $id);
        return true;
    }
}
