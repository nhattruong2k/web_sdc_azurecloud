<?php


namespace App\Tasks\Partners;


use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\PartnersRepository;

class CountPartnerTask extends Task
{
    protected PartnersRepository $partnersRepository;
    public function __construct(PartnersRepository $partnersRepository)
    {
        $this->partnersRepository = $partnersRepository;
    }

    public function run(){
        return $this->partnersRepository->count();
    }
}
