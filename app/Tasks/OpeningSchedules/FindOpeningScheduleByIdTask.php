<?php

namespace App\Tasks\OpeningSchedules;

use App\Cores\Abstracts\Task;
use App\Exceptions\NotFoundException;
use App\Repositories\Contracts\OpeningScheduleRepository;
use Exception;

class FindOpeningScheduleByIdTask extends Task
{
    protected OpeningScheduleRepository $openingScheduleRepository;

    public function __construct(OpeningScheduleRepository $openingScheduleRepository) {
        $this->openingScheduleRepository = $openingScheduleRepository;
    }

    public function run(int $id, $columns = ['*'])
    {
        try {
            $opening_schedule = $this->openingScheduleRepository->with('courses:id,title,time')->find($id, $columns);
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $opening_schedule;
    }
}
