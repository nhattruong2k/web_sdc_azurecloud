<?php


namespace App\Tasks\Users;


use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\UserRepository;

class GetListUserTask extends Task
{
    protected UserRepository $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function run()
    {
        return $this->userRepository->active()->pluck('name', 'id');
    }
}
