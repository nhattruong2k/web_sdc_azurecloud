<?php

namespace App\Tasks\GeneralSettings;

use App\Helpers\Cache;
use App\Libs\Constants;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\GeneralSettingRepository;

class FindSettingTask extends Task
{
    protected GeneralSettingRepository $generalSettingRepository;
    public function __construct(GeneralSettingRepository $generalSettingRepository)
    {
        $this->generalSettingRepository = $generalSettingRepository;
    }

    public function run(array $columns = ['*']){
        $columns = [
            'name',
            'description',
            'email',
            'phone',
            'address',
            'facebook',
            'logo',
            'favicon',
            'thumbnail',
            'content_introduce',
            'facebook_pixel',
            'google_analytics',
            'mailer',
            'host',
            'port',
            'use_name',
            'password',
            'encrytion',
            'from_address'
,        ];
        if (empty(Cache::read(Constants::$fileName['generalSetting']))){
            $settings = $this->generalSettingRepository->get($columns);
            Cache::write(Constants::$fileName['generalSetting'],$settings);
        }
        $data = Cache::read(Constants::$fileName['generalSetting']);
        return $data;
    }
}
