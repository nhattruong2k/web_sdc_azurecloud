<?php

namespace App\Policies;

use App\Models\TeamTeachers;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamTeacherPolicy
{
    use HandlesAuthorization;

    public function view()
    {
        return checkPermission(config('permission.access.teachers.list'));
    }


    public function create()
    {
        return checkPermission(config('permission.access.teachers.create'));
    }

    public function update()
    {
        return checkPermission(config('permission.access.teachers.update'));
    }


    public function delete()
    {
        return checkPermission(config('permission.access.teachers.delete'));
    }

}
