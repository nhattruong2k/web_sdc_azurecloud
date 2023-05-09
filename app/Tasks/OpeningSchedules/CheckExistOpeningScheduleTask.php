<?php


namespace App\Tasks\OpeningSchedules;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\OpeningScheduleRepository;


class CheckExistOpeningScheduleTask extends Task
{
    protected OpeningScheduleRepository $openingScheduleRepository;

    public function __construct(OpeningScheduleRepository $openingScheduleRepository) {
        $this->openingScheduleRepository = $openingScheduleRepository;
    }

    public function run($course_id, $id = null)
    {
        return $this->openingScheduleRepository->scopeQuery(function ($query) use($course_id, $id) {
            $query = $query->whereCourseId($course_id);
            if (!empty($id)) {
                $query = $query->where('id', '!=', $id);
            }
            return $query;
        })->exists();
    }
}
