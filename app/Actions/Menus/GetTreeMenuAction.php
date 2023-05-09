<?php
namespace App\Actions\Menus;

use App\Cores\Abstracts\Action;
use App\Tasks\Menus\GetTreeMenuTask;

class GetTreeMenuAction extends Action {
    public function run($id = null, array $columns = ['*'])
    {
        $getMenus = resolve(GetListMenuAction::class)->run($id, $columns);
        if(!empty($id)){
            $menus = resolve(FindMenuByIdAction::class)->run($id);
            $getMenus = resolve(GetListMenuAction::class)->run($id, $columns);
            
            return resolve(GetTreeMenuTask::class)->run($getMenus, $menus->parent_id);
        }
        $menus = resolve(GetTreeMenuTask::class)->run($getMenus);
        return $menus;
    }
}
?>