<?php

namespace App\Actions\OpeningSchedules;

use App\Cores\Abstracts\Action;
use App\Tasks\OpeningSchedules\FindOpeningScheduleByIdTask;
use App\Tasks\OpeningSchedules\UpdateOpeningScheduleTask;
use Illuminate\Http\Request;

class UpdateOpeningScheduleAction extends Action
{
    public function run(int $id, Request $request)
    {
        resolve(FindOpeningScheduleByIdTask::class)->run($id);
        $data = $request->all();
        for ($i = 0; $i < count($data['names']); $i++){
            $datas[$i]['name'] = $data['names'][$i];
            $datas[$i]['open_time'] = $data['open_times'][$i];
            $datas[$i]['study_time'] = $data['study_times'][$i];
            $datas[$i]['counselor_id'] = $data['counselors'][$i];
        }
        $data['data'] = json_encode($datas);
        $data['status'] = !empty($data['status']) ? $data['status'] : 0;
        $data['tuition'] = preg_replace('/[^0-9\.]+/', "", $data['tuition']);
        $data['preferential_tuition'] = preg_replace('/[^0-9\.]+/', "", $data['preferential_tuition']);
        $opening_schedule = resolve(UpdateOpeningScheduleTask::class)->run($data, $id);
        return $opening_schedule;
    }
}
