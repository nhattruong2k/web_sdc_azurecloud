<?php


namespace App\Actions\statistNumbers;


use App\Tasks\StatistNumbers\GetAllStatistNumbersTask;
use Illuminate\Http\Request;

class GetAllStatistNumbersAction
{
    public function run($column = ['*']){
        return resolve(GetAllStatistNumbersTask::class)->run($column);
    }
}

?>