<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class ActivityLogPolicy
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
        return checkPermission(config('permission.access.activity_logs.list'));
    }

    public function delete()
    {
        return checkPermission(config('permission.access.activity_logs.delete'));
    }
}
