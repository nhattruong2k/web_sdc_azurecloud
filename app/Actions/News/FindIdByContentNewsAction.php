<?php 
namespace App\Actions\News;
use App\Cores\Abstracts\Action;
use App\Tasks\News\FindIdByContentNewsTask;

class FindIdByContentNewsAction extends Action {
    public function run($request, array $columns = ['*'])
    {
        $idContent = $request->id;
        return resolve(FindIdByContentNewsTask::class)->run($idContent, $columns);
    }
}

?>