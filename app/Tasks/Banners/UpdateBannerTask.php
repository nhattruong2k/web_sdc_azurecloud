<?php

namespace App\Tasks\Banners;

use App\Cores\Abstracts\Task;
use App\Exceptions\NotFoundException;
use App\Exceptions\UpdateResourceFailedException;
use Exception;
use App\Exceptions\InternalErrorException;
use App\Repositories\Contracts\BannersRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateBannerTask extends Task
{

    protected BannersRepository $bannersRepository;

    public function __construct(BannersRepository $bannersRepository)
    {
        $this->bannersRepository = $bannersRepository;
    }

    public function run($data, int $bannerId)
    {
        if (empty($data)) {
            throw new InternalErrorException(__('common.inputs_empty'));
        }
        try {
            $banner = $this->bannersRepository->update($data, $bannerId);
        } catch (ModelNotFoundException $ex) {
            throw new NotFoundException(__('common.not_found'));
        } catch (Exception $ex) {
            throw new InternalErrorException(__('banners.update_error'));
        }

        return $banner;
    }
}
