<?php

namespace App\Actions\Partners;

use App\Cores\Abstracts\Action;
use App\Models\Partners;
use App\SubActions\Common\UploadImageSubAction;
use App\Tasks\Partners\CreatePartnerTask;
use Illuminate\Http\Request;

class CreatePartnerAction extends Action
{
    public function run (Request $request)
    {
        $data = $request->all();
        if($request->hasFile('image')){
            $this->handleUploadImage($request->file('image'), $data);
        }
        $partner = resolve(CreatePartnerTask::class)->run($data);
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
