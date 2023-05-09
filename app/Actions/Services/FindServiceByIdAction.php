<?php
namespace  App\Actions\Services;

use App\Cores\Abstracts\Action;
use App\Tasks\Services\FindServiceByIdTask;

class FindServiceByIdAction extends Action{

    public function run(int  $id, array $columns = ['*'])
    {
        $service =  resolve(FindServiceByIdTask::class)->run($id, $columns);
        if ($service->link){
            $service->link = json_decode($service->link);
            $service->count = count($service->link);
        }
        return $service;
    }
}

?>
