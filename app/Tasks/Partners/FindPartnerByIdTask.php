<?php

namespace App\Tasks\Partners;

use App\Cores\Abstracts\Task;
use App\Exceptions\NotFoundException;
use App\Repositories\Contracts\PartnersRepository;
use Exception;

class FindPartnerByIdTask extends Task
{
    protected PartnersRepository $partnersRepository;

    public function __construct(PartnersRepository $partnersRepository) {
        $this->partnersRepository = $partnersRepository;
    }

    public function run(int $id, $columns = ['*'])
    {
        try {
            $partner = $this->partnersRepository->find($id, $columns);
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $partner;
    }
}
