<?php


namespace App\Tasks\Users;


use App\Cores\Abstracts\Task;
use App\Exceptions\NotFoundException;
use App\Repositories\Contracts\UsersRepository;

class FindUserByEmailTask extends Task
{
    protected UsersRepository $userRepository;
    public function __construct(UsersRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function run(string $email, array $column = ['*'])
    {
        try {
            $user = $this->userRepository->where('email', $email)->select($column)->first();
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $user;
    }
}
