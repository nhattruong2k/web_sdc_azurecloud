<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ActivityLog.
 *
 * @package namespace App\Models;
 */
class ActivityLog extends Model implements Transformable
{
    use TransformableTrait;

    const VIEW = 'activity_logs_view';
    const DELETE = 'activity_logs_delete';

    /**
     * The attributes that are mass assignable.
     *
     * @var array 
     */
    protected $fillable = [
        'id',
        'log_name',
        'description',
        'input_data',
        'code',
        'ip',
        'user_id',
        'url',
        'method',
        'agent',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
