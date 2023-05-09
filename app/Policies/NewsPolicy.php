<?php

namespace App\Policies;

use App\Models\News;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsPolicy
{
    use HandlesAuthorization;

    public function view()
    {
        return checkPermission(config('permission.access.news.list'));
    }


    public function create()
    {
        return checkPermission(config('permission.access.news.create'));
    }

    public function update()
    {
        return checkPermission(config('permission.access.news.update'));
    }


    public function delete()
    {
        return checkPermission(config('permission.access.news.delete'));
    }

}