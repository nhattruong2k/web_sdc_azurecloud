<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GeneralSettingPolicy
{
    use HandlesAuthorization;

    public function view()
    {
        return checkPermission(config('permission.access.general_settings.list'));
    }
}
