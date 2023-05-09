<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Roles.
 *
 * @package namespace App\Models;
 */
class Roles extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    const LIST = 'role_list';
    const CREATE = 'role_create';
    const UPDATE = 'role_update';
    const DELETE = 'role_delete';
    protected $fillable = [
        'id',
        'name',
        'description',
        'is_visible',
        'created_by',
        'updated_by',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_visible', 1);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permissions::class, 'permission_roles', 'role_id', 'permission_id');
    }

}
