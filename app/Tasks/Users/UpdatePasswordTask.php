<?php


namespace App\Tasks\Users;

use App\Cores\Abstracts\Task;
use App\Exceptions\NotFoundException;
use App\Repositories\Contracts\UsersRepository;

class UpdatePasswordTask extends Task
{
    protected UsersRepository $userRepository;
    public function __construct(UsersRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function run(array $data, string $email)
    {
        try {
            $password_reset = $this->userRepository->whereEmail($email)->update($data);
        } catch (\Exception $ex) {
            throw new NotFoundException(__('common.create_error'));
        }
        return $password_reset;
    }}
