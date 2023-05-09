<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
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
        return checkPermission(config('permission.access.questions.list'));
    }


    public function create()
    {
        return checkPermission(config('permission.access.questions.create'));
    }

    public function update()
    {
        return checkPermission(config('permission.access.questions.update'));
    }


    public function delete()
    {
        return checkPermission(config('permission.access.questions.delete'));
    }
}
