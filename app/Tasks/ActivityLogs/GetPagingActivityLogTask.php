<?php

namespace App\Tasks\ActivityLogs;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\ActivityLogRepository;

class GetPagingActivityLogTask extends Task
{
    protected ActivityLogRepository $activityLogRepository;

    public function __construct(ActivityLogRepository $activityLogRepository)
    {
        $this->activityLogRepository = $activityLogRepository;
    }

    public function run(array $param, array $columns = ['*'])
    {
        $columns = [
            'activity_logs.id',
            'activity_logs.log_name',
            'activity_logs.description',
            'activity_logs.input_data',
            'activity_logs.code',
            'activity_logs.ip',
            'activity_logs.user_id',
            'activity_logs.url',
            'activity_logs.method',
            'activity_logs.agent',
            'activity_logs.created_at',
        ];
        $activityLogs = $this->activityLogRepository->scopeQuery(function ($q) use ($param){
            if (isset($param['search']) && $param['search']){
                $q->where('activity_logs.log_name', 'like', "%" . $param['search'] . "%");
            }

            if(!empty($param['from_date']) && !empty($param['to_date'])){
                $q->whereBetween('activity_logs.created_at', [$param['from_date'], $param['to_date']]);
            }
            
            if(empty($param['to_date']) && !empty($param['from_date'])){
                $q->where('activity_logs.created_at', '>=', $param['from_date']);
            }

            if(!empty($param['to_date']) && empty($param['from_date'])){
                $q->where('activity_logs.created_at', '<=', $param['to_date']);
            }
            return $q;
        });
        $activityLogs->orderBy($param['sortfield'], $param['sorttype']);
        return $activityLogs->paginate($param['limit'], $columns);
    }
}