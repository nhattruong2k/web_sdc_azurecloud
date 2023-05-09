<?php


namespace App\Tasks\OpeningSchedules;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\OpeningScheduleRepository;

class GetAllOpeningScheduleTask extends Task
{
    protected OpeningScheduleRepository $openingScheduleRepository;

    public function __construct(OpeningScheduleRepository $openingScheduleRepository)
    {
        $this->openingScheduleRepository = $openingScheduleRepository;
    }

    public function run(array $columns = ['*'])
    {
        return $this->openingScheduleRepository->active()->with('courses:id,title,slug,time')->select($columns)->get();
    }
}
