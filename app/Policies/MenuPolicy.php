<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class MenuPolicy
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
        return checkPermission(config('permission.access.menus.list'));
    }


    public function create()
    {
        return checkPermission(config('permission.access.menus.create'));
    }

    public function update()
    {
        return checkPermission(config('permission.access.menus.update'));
    }


    public function delete()
    {
        return checkPermission(config('permission.access.menus.delete'));
    }
}
