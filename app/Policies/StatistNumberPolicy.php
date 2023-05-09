<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class StatistNumberPolicy
{
    use HandlesAuthorization;

    public function view()
    {
        return checkPermission(config('permission.access.statistNumbers.list'));
    }


    public function create()
    {
        return checkPermission(config('permission.access.statistNumbers.create'));
    }

    public function update()
    {
        return checkPermission(config('permission.access.statistNumbers.update'));
    }


    public function delete()
    {
        return checkPermission(config('permission.access.statistNumbers.delete'));
    }
}
