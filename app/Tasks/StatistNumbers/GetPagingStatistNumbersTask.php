<?php

namespace App\Tasks\StatistNumbers;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\StatistNumbersRepository;

class GetPagingStatistNumbersTask extends Task
{

    protected StatistNumbersRepository $statistNumbersRepository;
    public function __construct(StatistNumbersRepository $statistNumbersRepository)
    {
        $this->statistNumbersRepository = $statistNumbersRepository;
    }

    public function run(array $param, array $columns = ['*'])
    {
        
        $numbers = $this->statistNumbersRepository->scopeQuery(function ($query) use ($param) {
            if ((isset($param['search']) && $param['search'])) {
                $query->where('title', 'like', "%" . $param['search'] . "%")->orWhere('figures', 'like', "%" . $param['search'] . "%");
            }

            if (!empty($param['status'])) {
                $query->where('status', $param['status']);
            }
            return $query;
        });
        $numbers->orderBy($param['sortfield'], $param['sorttype']);
        return $numbers->paginate($param['limit'], $columns);
    }
}
?>