<?php


namespace App\Tasks\Banners;

use App\Repositories\Contracts\BannersRepository;
use App\Repositories\Contracts\UsersRepository;

class CheckExistTitleTask
{
    protected BannersRepository $bannersRepository;

    public function __construct(BannersRepository $bannersRepository) {
        $this->bannersRepository = $bannersRepository;
    }

    public function run($title, $id = null)
    {
        return $this->bannersRepository->scopeQuery(function ($query) use($title, $id) {
            $query = $query->whereTitle($title);
            if (!empty($id)) {
                $query = $query->where('id', '!=', $id);
            }
            return $query;
        })->exists();
    }
}
