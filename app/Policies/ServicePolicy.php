<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServicePolicy
{
    use HandlesAuthorization;

    public function view()
    {
        return checkPermission(config('permission.access.services.list'));
    }


    public function create()
    {
        return checkPermission(config('permission.access.services.create'));
    }

    public function update()
    {
        return checkPermission(config('permission.access.services.update'));
    }


    public function delete()
    {
        return checkPermission(config('permission.access.services.delete'));
    }

}
