<?php

namespace App\Actions\GeneralSettings;

use App\Cores\Abstracts\Action;
use App\Models\GeneralSetting;
use App\Repositories\Contracts\GeneralSettingRepository;
use App\SubActions\Common\UploadImageSubAction;
use App\Tasks\GeneralSettings\CreateGeneralSettingTask;
use App\Tasks\GeneralSettings\UpdateGeneralSettingTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SaveGeneralSettingAction extends Action
{
    protected GeneralSettingRepository $generalSettingRepository;
    public function __construct(GeneralSettingRepository $generalSettingRepository)
    {
        $this->generalSettingRepository = $generalSettingRepository;
    }

    public function run(Request $request)
    {
        $data = $request->all();
        $setting = $this->generalSettingRepository->getFormData();
        if ($request->hasFile('logo')){
            $this->handleUploadLogo($request->file('logo'), $data);
        }else{
            if ($data['remove_logo']){
                $data['logo'] = '';
            }
        }
        if ($request->hasFile('favicon')){
            $this->handleUploadFavicon($request->file('favicon'), $data);
        }else{
            if ($data['remove_favicon']){
                $data['favicon'] = '';
            }
        }

        if ($request->hasFile('thumbnail')){
            $this->handleUploadThumbnail($request->file('thumbnail'), $data);
        }else{
            if ($data['remove_thumbnail']){
                $data['thumbnail'] = '';
            }
        }
        $data['password'] = Crypt::encryptString($data['password']);
        if (isset($setting)){
            return resolve(UpdateGeneralSettingTask::class)->run($data, $setting->id);
        }else{
            return resolve(CreateGeneralSettingTask::class)->run($data);
        }
    }

    public function handleUploadLogo($file, array &$data){
        $name = 'logo_setting' . time();
        $filename = resolve(UploadImageSubAction::class)->run($file, $name, GeneralSetting::FOLDER_IMAGES);
        if(!empty($filename)) {
            $data['logo'] = $filename;
        }
    }
    public function handleUploadFavicon($file, array &$data){
        $name = 'favicon_setting' . time();
        $filename = resolve(UploadImageSubAction::class)->run($file, $name, GeneralSetting::FOLDER_IMAGES);
        if(!empty($filename)) {
            $data['favicon'] = $filename;
        }
    }
    public function handleUploadThumbnail($file, array &$data){
        $name = 'thumbnail_setting' . time();
        $filename = resolve(UploadImageSubAction::class)->run($file, $name, GeneralSetting::FOLDER_IMAGES);
        if(!empty($filename)) {
            $data['thumbnail'] = $filename;
        }
    }
}
