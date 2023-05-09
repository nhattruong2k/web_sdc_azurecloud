<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    public function view()
    {
        return checkPermission(config('permission.access.courses.list'));
    }


    public function create()
    {
        return checkPermission(config('permission.access.courses.create'));
    }

    public function update()
    {
        return checkPermission(config('permission.access.courses.update'));
    }


    public function delete()
    {
        return checkPermission(config('permission.access.courses.delete'));
    }

}
