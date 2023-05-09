<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function view()
    {
        return checkPermission(config('permission.access.roles.list'));
    }


    public function create()
    {
        return checkPermission(config('permission.access.roles.create'));
    }

    public function update()
    {
        return checkPermission(config('permission.access.roles.update'));
    }


    public function delete()
    {
        return checkPermission(config('permission.access.roles.delete'));
    }

}
