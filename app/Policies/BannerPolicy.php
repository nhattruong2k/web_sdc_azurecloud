<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BannerPolicy
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
        return checkPermission(config('permission.access.banners.list'));
    }


    public function create()
    {
        return checkPermission(config('permission.access.banners.create'));
    }

    public function update()
    {
        return checkPermission(config('permission.access.banners.update'));
    }


    public function delete()
    {
        return checkPermission(config('permission.access.banners.delete'));
    }
}
