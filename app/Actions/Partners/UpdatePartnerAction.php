<?php

namespace App\Actions\Partners;

use App\Cores\Abstracts\Action;
use App\Models\Partners;
use App\SubActions\Common\UploadImageSubAction;
use App\Tasks\Partners\FindPartnerByIdTask;
use App\Tasks\Partners\UpdatePartnerTask;
use Illuminate\Http\Request;

class UpdatePartnerAction extends Action
{
    public function run(int $id, Request $request)
    {
        $partner = resolve(FindPartnerByIdTask::class)->run($id);
        $data = $request->all();
        $data['status'] = isset($data['status']) ? 1 :0;
        if ($request->hasFile('image')){
            $this->handleUploadImage($request->file('image'), $data);
        }
        $partner = resolve(UpdatePartnerTask::class)->run($data, $id);
        return $partner;
    }

    private function handleUploadImage($file, array &$data)
    {
        $filename = resolve(UploadImageSubAction::class)->run($file, $data['title'], Partners::FOLDER_IMAGES);
        if(!empty($filename)) {
            $data['image'] = $filename;
        }
    }
}
