<?php

namespace App\Tasks\Partners;

use App\Cores\Abstracts\Task;
use App\Exceptions\InternalErrorException;
use App\Repositories\Contracts\PartnersRepository;
use Exception;

class CreatePartnerTask extends Task
{

    public PartnersRepository $partnersRepository;
    public function __construct(PartnersRepository $partnersRepository)
    {
        $this->partnersRepository = $partnersRepository;
    }
    public function run(array $data)
    {
        try {
            $partner = $this->partnersRepository->create($data);    
        } catch (Exception $ex) {
            throw new InternalErrorException(__('partners.create_error'));   
        }
        return $partner;
    }
}
