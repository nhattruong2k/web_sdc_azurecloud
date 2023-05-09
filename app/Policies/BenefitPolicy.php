<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BenefitPolicy
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
        return checkPermission(config('permission.access.benefits.list'));
    }


    public function create()
    {
        return checkPermission(config('permission.access.benefits.create'));
    }

    public function update()
    {
        return checkPermission(config('permission.access.benefits.update'));
    }


    public function delete()
    {
        return checkPermission(config('permission.access.benefits.delete'));
    }
}
