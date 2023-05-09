<?php

namespace App\Tasks\Partners;

use App\Cores\Abstracts\Task;
use App\Exceptions\NotFoundException;
use App\Exceptions\UpdateResourceFailedException;
use Exception;
use App\Exceptions\InternalErrorException;
use App\Repositories\Contracts\PartnersRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdatePartnerTask extends Task
{

    protected PartnersRepository $partnersRepository;

    public function __construct(PartnersRepository $partnersRepository)
    {
        $this->partnersRepository = $partnersRepository;
    }

    public function run($data, int $partnerId)
    {
        if (empty($data)) {
            throw new InternalErrorException(__('common.inputs_empty'));
        }
        try {
            $partner = $this->partnersRepository->update($data, $partnerId);
        } catch (ModelNotFoundException $ex) {
            throw new NotFoundException(__('common.not_found'));
        } catch (Exception $ex) {
            throw new InternalErrorException(__('partners.update_error'));
        }

        return $partner;
    }
}
