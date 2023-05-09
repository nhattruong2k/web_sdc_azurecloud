<?php

namespace App\Policies;

use App\Models\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CourseCategoryPolicy
{
    use HandlesAuthorization;

    public function view()
    {
        return checkPermission(config('permission.access.course_categories.list'));
    }

    public function create()
    {
        return checkPermission(config('permission.access.course_categories.create'));
    }

    public function update()
    {
        return checkPermission(config('permission.access.course_categories.update'));
    }


    public function delete()
    {
        return checkPermission(config('permission.access.course_categories.delete'));
    }

}
