<?php

namespace App\Tasks\Banners;

use App\Cores\Abstracts\Task;
use App\Exceptions\InternalErrorException;
use App\Repositories\Contracts\BannersRepository;
use Exception;

class CreateBannerTask extends Task
{

    public BannersRepository $bannersRepository;
    public function __construct(BannersRepository $bannersRepository)
    {
        $this->bannersRepository = $bannersRepository;
    }
    public function run(array $data)
    {
        try {
            $banner = $this->bannersRepository->create($data);
        } catch (Exception $ex) {
            throw new InternalErrorException(__('banners.create_error'));   
        }
        return $banner;
    }
}
