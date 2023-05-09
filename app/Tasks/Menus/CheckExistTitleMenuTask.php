<?php


namespace App\Tasks\Menus;

use App\Repositories\Contracts\MenusRepository;

class CheckExistTitleMenuTask
{
    protected MenusRepository $menusRepository;

    public function __construct(MenusRepository $menusRepository) {
        $this->menusRepository = $menusRepository;
    }

    public function run($title, $id = null)
    {
        return $this->menusRepository->scopeQuery(function ($query) use($title, $id) {
            $query = $query->whereTitle($title);
            if (!empty($id)) {
                $query = $query->where('id', '!=', $id);
            }
            return $query;
        })->exists();
    }
}
