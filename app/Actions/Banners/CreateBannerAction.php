<?php

namespace App\Actions\Banners;

use App\Cores\Abstracts\Action;
use App\Models\Banners;
use App\SubActions\Common\UploadImageSubAction;
use App\Tasks\Banners\CreateBannerTask;
use Illuminate\Http\Request;

class CreateBannerAction extends Action
{
    public function run (Request $request)
    {
        $data = $request->all();
        if($request->hasFile('link')){
            $this->handleUploadImage($request->file('link'), $data);
        }
        $banner = resolve(CreateBannerTask::class)->run($data);
        return $banner;
    }
    private function handleUploadImage($file, array &$data)
    {
        $filename = resolve(UploadImageSubAction::class)->run($file, $data['title'], Banners::FOLDER_IMAGES);
        if(!empty($filename)) {
            $data['link'] = $filename;
        }
    }
}
