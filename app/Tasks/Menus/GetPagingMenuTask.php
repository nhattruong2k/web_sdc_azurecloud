<?php

namespace App\Tasks\Menus;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\MenusRepository;

class GetPagingMenuTask extends Task
{
    protected MenusRepository $menusRepository;

    public function __construct(MenusRepository $menusRepository)
    {
        $this->menusRepository = $menusRepository;
    }

    public function run(array $param, array $columns = ['*'])
    {
        $menus= $this->menusRepository->scopeQuery(function ($q) use ($param){
            if (isset($param['search']) && $param['search']){
                $q->where('menus.title', 'like', "%" . $param['search'] . "%");
            }
            return $q;
        });
        $menus->orderBy($param['sortfield'], $param['sorttype']);
   
        return $menus->paginate($param['limit'], $columns);
    }
}