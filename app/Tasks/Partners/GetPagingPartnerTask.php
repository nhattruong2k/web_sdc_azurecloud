<?php

namespace App\Tasks\Partners;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\PartnersRepository;

class GetPagingPartnerTask extends Task
{
    protected PartnersRepository $partnersRepository;

    public function __construct(PartnersRepository $partnersRepository)
    {
        $this->partnersRepository = $partnersRepository;
    }

    public function run(array $param, array $columns = ['*'])
    {
        $columns = [
            'partners.id',
            'partners.title',
            'partners.image',
            'partners.description',
            'partners.status',
        ];
        $partners = $this->partnersRepository->scopeQuery(function ($q) use ($param){
            if (isset($param['search']) && $param['search']){
                $q->where('partners.title', 'like', "%" . $param['search'] . "%");
            }
            return $q;
        });
        $partners->orderBy($param['sortfield'], $param['sorttype']);
   
        return $partners->paginate($param['limit'], $columns);
    }
}