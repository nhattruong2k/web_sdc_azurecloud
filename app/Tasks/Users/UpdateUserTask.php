<?php

namespace App\Tasks\Users;

use App\Cores\Abstracts\Task;
use App\Exceptions\NotFoundException;
use App\Exceptions\UpdateResourceFailedException;
use App\Repositories\Contracts\UsersRepository;
use Exception;
use App\Exceptions\InternalErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateUserTask extends Task
{

    protected UsersRepository $userRepository;

    public function __construct(UsersRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function run($data, int $userId)
    {
        if (empty($data)) {
            throw new InternalErrorException(__('common.inputs_empty'));
        }
        try {
            $user = $this->userRepository->update($data, $userId);
        } catch (ModelNotFoundException $ex) {
            throw new NotFoundException(__('common.not_found'));
        } catch (Exception $ex) {
            throw new InternalErrorException(__('users.update_error'));
        }

        return $user;
    }
}
