<?php


namespace App\Tasks\Partners;


use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\PartnersRepository;

class GetAllPartnerTask extends Task
{
    protected $partnerRepository;

    public function __construct(PartnersRepository $partnerRepository)
    {
        $this->partnerRepository = $partnerRepository;
    }

    public function run($column = ['*']){
        $partners = $this->partnerRepository->active()->get($column);
        return $partners;
    }
}
