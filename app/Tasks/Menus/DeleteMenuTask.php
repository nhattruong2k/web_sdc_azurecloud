<?php 
namespace App\Tasks\Menus;

use App\Cores\Abstracts\Task;
use App\Exceptions\InternalErrorException;
use App\Repositories\Contracts\MenusRepository;
use App\Traits\DeleteModelTrait;
use Exception;

class DeleteMenuTask extends Task 
{
    use DeleteModelTrait;
    protected MenusRepository $menusRepository;

    public function __construct(MenusRepository $menusRepository)
    {
        $this->menusRepository = $menusRepository;
    }

    public function run(string $ids)
    { 
        try {
            $arr_ids = explode(",", $ids);
            $menuParents = $this->menusRepository->whereIn('id', $arr_ids)->get();
            foreach($menuParents as $k){
                switch (($k->childrenMenu)->isNotEmpty()) {
                    case(true):
                        return notify()->warning(trans('menus.delete_error_children'));
                        break;
                    case(false): 
                        $this->deleteModelTrait($this->menusRepository, $ids);
                        return notify()->success((trans('menus.delete_successfully')));
                        break;
                }
                
            }
            
        } catch (Exception $ex) {
            throw new InternalErrorException(__('menus.create_error'));
        }
    }
}
?>