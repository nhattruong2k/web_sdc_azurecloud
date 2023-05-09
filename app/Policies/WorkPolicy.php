<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class WorkPolicy
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
        return checkPermission(config('permission.access.works.list'));
    }


    public function create()
    {
        return checkPermission(config('permission.access.works.create'));
    }

    public function update()
    {
        return checkPermission(config('permission.access.works.update'));
    }


    public function delete()
    {
        return checkPermission(config('permission.access.works.delete'));
    }
}
