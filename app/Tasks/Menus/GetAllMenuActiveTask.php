<?php
namespace App\Tasks\Menus;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\MenusRepository;

class GetAllMenuActiveTask extends Task
{
    protected MenusRepository $menuRepository;

    public function __construct(MenusRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    public function run()
    {
        return $this->menuRepository->active()->orderBy('order_by', 'ASC')->get([
            'id',
            'title',
            'slug',
            'parent_id',
        ]);
    }
}
