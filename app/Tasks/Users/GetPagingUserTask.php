<?php

namespace App\Tasks\Users;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\UsersRepository;

class GetPagingUserTask extends Task
{

    protected UsersRepository $userRepository;

    public function __construct(UsersRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function run(array $param, array $columns = ['*'])
    {
        $columns = [
            'users.id',
            'users.name',
            'users.role',
            'users.email',
            'users.phone',
            'users.address',
            'users.gender',
            'users.day_of_birth',
            'users.avatar',
            'users.is_visible',
        ];
        $users = $this->userRepository->scopeQuery(function ($query) use ($param) {
            if ((isset($param['search']) && $param['search'])) {
                $query->where('users.name', 'like', "%" . $param['search'] . "%")
                      ->orWhere('users.email', 'like', "%" . $param['search'] . "%");
            }

            if (!empty($param['is_visible'])) {
                $query->where('users.is_visible', $param['is_visible']);
            }
            return $query;
        });
        $users->orderBy($param['sortfield'], $param['sorttype']);
        return $users->paginate($param['limit'], $columns);
    }
}
