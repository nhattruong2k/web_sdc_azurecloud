<?php

namespace App\Tasks\Users;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\UsersRepository;
use App\Exceptions\InternalErrorException;
use Exception;

class DestroyUserByIdsTask extends Task
{

    protected UsersRepository $userRepository;

    public function __construct(UsersRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function run(array $arr_ids)
    {
        try {
            return $this->userRepository->delete($arr_ids);
        } catch (Exception $ex) {
            throw new InternalErrorException(__('users.delete_error'));
        }
    }
}
