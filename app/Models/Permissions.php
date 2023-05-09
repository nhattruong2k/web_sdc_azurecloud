<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Permissions.
 *
 * @package namespace App\Models;
 */
class Permissions extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'key_code'
    ];
    public $timestamps = false;

    public function permissionChildrent(){
        return $this->hasMany(Permissions::class,'type', 'key_code');
    }

}
