<?php


namespace App\Tasks\Users;
use App\Repositories\Contracts\UsersRepository;

class CheckExistEmailTask
{
    protected UsersRepository $userRepository;

    public function __construct(UsersRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function run($email, $id = null)
    {
        return $this->userRepository->scopeQuery(function ($query) use($email, $id) {
            $query = $query->whereEmail($email);
            if (!empty($id)) {
                $query = $query->where('id', '!=', $id);
            }
            return $query;
        })->exists();
    }
}
