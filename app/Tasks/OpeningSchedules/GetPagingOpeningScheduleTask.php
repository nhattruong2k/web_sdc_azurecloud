<?php

namespace App\Tasks\OpeningSchedules;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\OpeningScheduleRepository;

class GetPagingOpeningScheduleTask extends Task
{

    protected OpeningScheduleRepository $openingScheduleRepository;

    public function __construct(OpeningScheduleRepository $openingScheduleRepository)
    {
        $this->openingScheduleRepository = $openingScheduleRepository;
    }

    public function run(array $param, array $columns = ['*'])
    {
        $columns = [
            'opening_schedules.id',
            'opening_schedules.course_id',
            'opening_schedules.tuition',
            'opening_schedules.preferential_tuition',
            'opening_schedules.lecturers',
            'opening_schedules.data',
            'opening_schedules.status',
        ];

        $opening_schedules = $this->openingScheduleRepository->scopeQuery(function ($query) use ($param) {
            $query->join('courses', 'courses.id', '=', 'opening_schedules.course_id');
            if ((isset($param['search']) && $param['search'])) {
                $query->where('opening_schedules.data', 'like', "%" . $param['search'] . "%")
                      ->orWhere('opening_schedules.lecturers', 'like', "%" . $param['search'] . "%")
                      ->orWhere('courses.title', 'like', "%" . $param['search'] . "%");
            }

            if (!empty($param['status'])) {
                $query->where('opening_schedules.status', $param['status']);
            }
            return $query;
        });
        $opening_schedules->orderBy($param['sortfield'], $param['sorttype']);
        return $opening_schedules->paginate($param['limit'], $columns);
    }
}
