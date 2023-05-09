<?php

namespace App\Tasks\OpeningSchedules;

use App\Cores\Abstracts\Task;
use App\Exceptions\NotFoundException;
use App\Repositories\Contracts\OpeningScheduleRepository;
use Exception;
use App\Exceptions\InternalErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateOpeningScheduleTask extends Task
{

    protected OpeningScheduleRepository $openingScheduleRepository;

    public function __construct(OpeningScheduleRepository $openingScheduleRepository)
    {
        $this->openingScheduleRepository = $openingScheduleRepository;
    }

    public function run($data, int $id)
    {
        if (empty($data)) {
            throw new InternalErrorException(__('common.inputs_empty'));
        }
        try {
            $opening_schedule = $this->openingScheduleRepository->update($data, $id);
        } catch (ModelNotFoundException $ex) {
            throw new NotFoundException(__('common.not_found'));
        } catch (Exception $ex) {
            throw new InternalErrorException(__('opening_schedules.update_error'));
        }

        return $opening_schedule;
    }
}
