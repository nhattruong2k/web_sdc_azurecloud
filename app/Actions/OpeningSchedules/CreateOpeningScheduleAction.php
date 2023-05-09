<?php

namespace App\Actions\OpeningSchedules;

use App\Cores\Abstracts\Action;
use App\Tasks\OpeningSchedules\CreateOpeningScheduleTask;
use Illuminate\Http\Request;

class CreateOpeningScheduleAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->all();
        $data['tuition'] = preg_replace('/[^0-9\.]+/', "", $data['tuition']);
        $data['preferential_tuition'] = preg_replace('/[^0-9\.]+/', "", $data['preferential_tuition']);
        for ($i = 0; $i < count($data['names']); $i++){
            $datas[$i]['name'] = $data['names'][$i];
            $datas[$i]['open_time'] = $data['open_times'][$i];
            $datas[$i]['study_time'] = $data['study_times'][$i];
            $datas[$i]['counselor_id'] = $data['counselors'][$i];
        }
        $data['data'] = json_encode($datas);
        $opening_schedule = resolve(CreateOpeningScheduleTask::class)->run($data);
        return $opening_schedule;
    }
}
