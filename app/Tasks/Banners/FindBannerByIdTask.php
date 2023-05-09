<?php

namespace App\Tasks\Banners;

use App\Cores\Abstracts\Task;
use App\Exceptions\NotFoundException;
use App\Repositories\Contracts\BannersRepository;
use Exception;

class FindBannerByIdTask extends Task
{
    protected BannersRepository $bannersRepository;

    public function __construct(BannersRepository $bannersRepository) {
        $this->bannersRepository = $bannersRepository;
    }

    public function run(int $id, $columns = ['*'])
    {
        try {
            $banner = $this->bannersRepository->find($id, $columns);
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $banner;
    }
}
