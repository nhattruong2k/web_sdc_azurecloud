<?php

namespace App\Tasks\Menus;

use App\Cores\Abstracts\Task;
use App\Exceptions\NotFoundException;
use App\Exceptions\UpdateResourceFailedException;
use Exception;
use App\Exceptions\InternalErrorException;
use App\Repositories\Contracts\MenusRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateMenuTask extends Task
{

    protected MenusRepository $menusRepository;

    public function __construct(MenusRepository $menusRepository)
    {
        $this->menusRepository = $menusRepository;
    }

    public function run($data, int $menuId)
    {
        if (empty($data)) {
            throw new InternalErrorException(__('common.inputs_empty'));
        }
        try {
            $menu = $this->menusRepository->update($data, $menuId);
        } catch (ModelNotFoundException $ex) {
            throw new NotFoundException(__('common.not_found'));
        } catch (Exception $ex) {
            throw new InternalErrorException(__('menus.update_error'));
        }

        return $menu;
    }
}
