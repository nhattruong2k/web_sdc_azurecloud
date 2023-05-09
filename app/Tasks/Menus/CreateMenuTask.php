<?php 
namespace App\Tasks\Menus;

use App\Cores\Abstracts\Task;
use App\Exceptions\InternalErrorException;
use App\Repositories\Contracts\MenusRepository;
use Exception;

class CreateMenuTask extends Task 
{
    protected MenusRepository $menusRepository;

    public function __construct(MenusRepository $menusRepository)
    {
        $this->menusRepository = $menusRepository;
    }

    public function run(array $data)
    { 
        try {
            $menu = $this->menusRepository->create($data);
        } catch (Exception $ex) {
            throw new InternalErrorException(__('menus.create_error'));
        }
        return $menu;
    }
}
?>