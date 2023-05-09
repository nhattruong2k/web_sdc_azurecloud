<?php 
namespace  App\Actions\Menus;

use App\Cores\Abstracts\Action;
use Illuminate\Http\Request;
use App\Tasks\Menus\CreateMenuTask;
use Illuminate\Support\Str;

class CreateMenuAction extends Action {

    public function run(Request $request){
        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);
        $menu = resolve(CreateMenuTask::class)->run($data);
        return $menu;
    }
}

?>