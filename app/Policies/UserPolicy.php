<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function view()
    {
        return checkPermission(config('permission.access.users.list'));
    }


    public function create()
    {
        return checkPermission(config('permission.access.users.create'));
    }

    public function update()
    {
        return checkPermission(config('permission.access.users.update'));
    }


    public function delete()
    {
        return checkPermission(config('permission.access.users.delete'));
    }

}
