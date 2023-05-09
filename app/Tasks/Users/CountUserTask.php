<?php


namespace App\Tasks\Users;


use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\UsersRepository;

class CountUserTask extends Task
{
    protected UsersRepository $usersRepository;
    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    public function run(){
        return $this->usersRepository->count();
    }
}
