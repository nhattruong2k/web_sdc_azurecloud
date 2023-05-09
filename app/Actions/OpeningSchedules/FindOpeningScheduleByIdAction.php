<?php

namespace App\Actions\OpeningSchedules;

use App\Cores\Abstracts\Action;
use App\Tasks\OpeningSchedules\FindOpeningScheduleByIdTask;
use App\Tasks\Users\FindUserByIdTask;

class FindOpeningScheduleByIdAction extends Action
{
    public function run(int  $id, array $columns = ['*'])
    {
        $opening_schedule = resolve(FindOpeningScheduleByIdTask::class)->run($id, $columns);
        if ($opening_schedule->data){
            $opening_schedule['data'] = json_decode($opening_schedule->data);
            $opening_schedule['count'] = count($opening_schedule['data']);

            foreach ($opening_schedule->data as $row){
                $counselors = resolve(FindUserByIdTask::class)->run($row->counselor_id, ['id','name','phone','email']);
                $row->counselors = $counselors;
            }
        }
        return $opening_schedule;
    }
}
