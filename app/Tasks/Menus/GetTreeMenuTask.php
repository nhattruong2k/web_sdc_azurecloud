<?php
namespace App\Tasks\Menus;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\MenusRepository;

class GetTreeMenuTask extends Task{
    protected MenusRepository $menusRepository;

    public function __construct(MenusRepository $menusRepository)
    {
        $this->menusRepository = $menusRepository;
    }

    public function run($menusData, $id = null, $parentId = 0, $level = 0, $html = "")
    {
        foreach($menusData as $menu){
            if ($menu['parent_id'] == $parentId) {
                $html .= "<option value='" . $menu['id'] . "' " . ($menu['id'] == $id ? ' selected' : '') . ">" . str_repeat('__', $level) . " " . $menu['title'] . " </option>";
                $newParentId = $menu['id'];
                $html = $this->run($menusData, $id, $newParentId, $level + 1, $html);
            }
        }
        return $html;
    }

    public function buildTree($menus, $parentId = 0) {
        $treeMenu = array();
        foreach ($menus as $menu) {
            if ($menu['parent_id'] == $parentId) {
                $children = $this->buildTree($menus, $menu['id']);
                if ($children) {
                    $menu['children'] = $children;
                }
                $treeMenu[] = $menu;
            }
        }
        return $treeMenu;
    }
}
?>
