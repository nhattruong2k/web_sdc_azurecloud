<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class ConsultationPolicy
{
    use HandlesAuthorization;

    public function view()
    {
        return checkPermission(config('permission.access.consultations.list'));
    }

    public function delete()
    {
        return checkPermission(config('permission.access.consultations.delete'));
    }

}
