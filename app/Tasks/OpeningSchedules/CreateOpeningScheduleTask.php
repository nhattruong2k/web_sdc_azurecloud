<?php

namespace App\Tasks\OpeningSchedules;

use App\Cores\Abstracts\Task;
use App\Exceptions\InternalErrorException;
use App\Repositories\Contracts\OpeningScheduleRepository;
use Exception;

class CreateOpeningScheduleTask extends Task
{

    protected OpeningScheduleRepository $openingScheduleRepository;

    public function __construct(OpeningScheduleRepository $openingScheduleRepository)
    {
        $this->openingScheduleRepository = $openingScheduleRepository;
    }

    /**
     * @param array $data
     * @return mixed
     * @throws InternalErrorException
     */
    public function run(array $data)
    {
        try {
            $opening_schedule = $this->openingScheduleRepository->create($data);
        } catch (Exception $ex) {
            throw new InternalErrorException(__('opening_schedules.create_error'));
        }
        return $opening_schedule;
    }
}
