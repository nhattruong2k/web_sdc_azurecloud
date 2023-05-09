<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConfigPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function view()
    {
        return checkPermission(config('permission.access.config.list'));
    }


    public function create()
    {
        return checkPermission(config('permission.access.config.create'));
    }

    public function update()
    {
        return checkPermission(config('permission.access.config.update'));
    }


    public function delete()
    {
        return checkPermission(config('permission.access.config.delete'));
    }
}
