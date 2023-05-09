<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamstudentPolicy
{
    use HandlesAuthorization;

    public function view()
    {
        return checkPermission(config('permission.access.students.list'));
    }


    public function create()
    {
        return checkPermission(config('permission.access.students.create'));
    }

    public function update()
    {
        return checkPermission(config('permission.access.students.update'));
    }


    public function delete()
    {
        return checkPermission(config('permission.access.students.delete'));
    }
}
?>
