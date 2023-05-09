<?php

namespace App\Tasks\Users;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\UsersRepository;
use App\Exceptions\NotFoundException;
use Exception;

class FindUserByIdTask extends Task
{
    protected UsersRepository $userRepository;

    public function __construct(UsersRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function run(int $id, $columns = ['*'])
    {
        try {
            $user = $this->userRepository->find($id, $columns);
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $user;
    }
}
