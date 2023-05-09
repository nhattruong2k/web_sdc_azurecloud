<?php

namespace App\Tasks\Users;

use App\Cores\Abstracts\Task;
use App\Exceptions\InternalErrorException;
use App\Repositories\Contracts\UsersRepository;
use Exception;

class CreateUserTask extends Task
{

    protected UsersRepository $userRepository;

    public function __construct(UsersRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function run(array $userData)
    {
        try {
            $user = $this->userRepository->create($userData);
        } catch (Exception $ex) {
            throw new InternalErrorException(__('users.create_error'));
        }
        return $user;
    }
}
