<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class FeelStudentPolicy
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
        return checkPermission(config('permission.access.feel_students.list'));
    }


    public function create()
    {
        return checkPermission(config('permission.access.feel_students.create'));
    }

    public function update()
    {
        return checkPermission(config('permission.access.feel_students.update'));
    }


    public function delete()
    {
        return checkPermission(config('permission.access.feel_students.delete'));
    }
}
