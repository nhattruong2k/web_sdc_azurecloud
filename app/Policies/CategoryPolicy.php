<?php

namespace App\Policies;

use App\Models\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function view()
    {
        return checkPermission(config('permission.access.categories.list'));
    }


    public function create()
    {
        return checkPermission(config('permission.access.categories.create'));
    }

    public function update()
    {
        return checkPermission(config('permission.access.categories.update'));
    }


    public function delete()
    {
        return checkPermission(config('permission.access.categories.delete'));
    }

}
