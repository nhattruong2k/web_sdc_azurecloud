<?php

namespace App\Tasks\StatistNumbers;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\StatistNumbersRepository;

class GetAllStatistNumbersTask extends Task
{
      protected StatistNumbersRepository $statistNumbersRepository;
    public function __construct(StatistNumbersRepository $statistNumbersRepository)
    {
        $this->statistNumbersRepository = $statistNumbersRepository;
    }

    public function run($column = ['*']){
        $statistNumber = $this->statistNumbersRepository->active()->select($column)->get();
        return $statistNumber;
    }
}
