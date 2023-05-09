<?php


namespace App\Tasks\Users;


use App\Repositories\Contracts\UsersRepository;

class CheckExistUsernameTask
{
    protected UsersRepository $userRepository;

    public function __construct(UsersRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function run($username, $id = null)
    {
        return $this->userRepository->scopeQuery(function ($query) use($username, $id) {
            $query = $query->whereUsername($username);
            if (!empty($id)) {
                $query = $query->where('id', '!=', $id);
            }
            return $query;
        })->exists();
    }
}
