<?php

namespace App\Actions\Banners;

use App\Cores\Abstracts\Action;
use App\Models\Banners;
use App\SubActions\Common\UploadImageSubAction;
use App\Tasks\Banners\FindBannerByIdTask;
use App\Tasks\Banners\UpdateBannerTask;
use Illuminate\Http\Request;

class UpdateBannerAction extends Action
{
    public function run(int $id, Request $request)
    {
        $banner = resolve(FindBannerByIdTask::class)->run($id);
        $data = $request->all();
        $data['status'] = isset($data['status']) ? 1 : 0;
        if ($request->hasFile('link')){
            $this->handleUploadImage($request->file('link'), $data);
        }
        $banner = resolve(UpdateBannerTask::class)->run($data, $id);
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
