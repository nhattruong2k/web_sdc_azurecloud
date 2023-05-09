<?php 
namespace  App\Actions\Menus;

use App\Cores\Abstracts\Action;
use App\Tasks\Menus\DeleteMenuTask;
use Illuminate\Http\Request;

class DeleteMenuAction extends Action {

    public function run(string $ids)
    {
        return resolve(DeleteMenuTask::class)->run($ids);
    }
}

?>