<?php


namespace App\Tasks\Banners;


use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\BannersRepository;

class GetAllBannerTask extends Task
{
    protected $bannerRepository;
    public function __construct(BannersRepository $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    public function run($column = ['*']){
        $banner = $this->bannerRepository->active()->select($column)->get();
        return $banner;
    }
}
