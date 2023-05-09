<?php

namespace App\Tasks\Menus;

use App\Cores\Abstracts\Task;
use App\Exceptions\NotFoundException;
use App\Repositories\Contracts\MenusRepository;
use Exception;

class FindMenuByIdTask extends Task
{
    protected MenusRepository $menusRepository;

    public function __construct(MenusRepository $menusRepository) {
        $this->menusRepository = $menusRepository;
    }

    public function run(int $id, $columns = ['*'])
    {
        try {
            $menu = $this->menusRepository->find($id, $columns);
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $menu;
    }
}
