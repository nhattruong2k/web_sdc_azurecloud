<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class OpeningSchedule.
 *
 * @package namespace App\Models;
 */
class OpeningSchedule extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    const LIST = 'opening_schedule_list';
    const CREATE = 'opening_schedule_create';
    const UPDATE = 'opening_schedule_update';
    const DELETE = 'opening_schedule_delete';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'course_id',
        'tuition',
        'preferential_tuition',
        'lecturers',
        'data',
        'status',
    ];

    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function courses(){
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
