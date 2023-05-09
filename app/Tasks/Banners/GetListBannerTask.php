<?php

namespace App\Tasks\Banners;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\BannersRepository;

class GetListBannerTask extends Task
{
    protected BannersRepository $bannersRepository;

    public function __construct(BannersRepository $bannersRepository)
    {
        $this->bannersRepository = $bannersRepository;
    }

    public function run(array $param, array $columns = ['*'])
    {
        $columns = [
            'banners.id',
            'banners.title',
            'banners.link',
            'banners.description',
            'banners.status',
            'banners.url',
        ];
        $banners = $this->bannersRepository->scopeQuery(function ($q) use ($param){
            if (isset($param['search']) && $param['search']){
                $q->where('banners.title', 'like', "%" . $param['search'] . "%");
            }
            return $q;
        });
        $banners->orderBy($param['sortfield'], $param['sorttype']);

        return $banners->paginate($param['limit'], $columns);
    }
}