<?php


namespace App\Tasks\Menus;


use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\MenusRepository;

class GetListMenuTask extends Task
{
    protected MenusRepository $menusRepository;
    public function __construct(MenusRepository $menusRepository)
    {
        $this->menusRepository = $menusRepository;
    }

    public function run($id = null, array $columns)
    {
        return $this->menusRepository->HiddenMenuOfItself($id)->with('childrenMenu')->active()->select($columns)->get();
    }
}
