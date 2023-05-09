<?php
namespace App\Tasks\Users;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\UsersRepository;

class GetPluckUserTask extends Task
{
    protected $usersRepository;
    public function __construct(UsersRepository $usersRepository){
        $this->usersRepository = $usersRepository;
    }

    public function run(){
        return $this->usersRepository->active()->notAdministrator()->pluck('name', 'id');
    }
}
