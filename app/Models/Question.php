<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Question.
 *
 * @package namespace App\Models;
 */
class Question extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    const LIST = 'questions_list';
    const CREATE = 'questions_create';
    const UPDATE = 'questions_update';
    const DELETE = 'questions_delete';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'question',
        'answer',
        'status'
    ];

    public function scopeActive(){
        return $q->where('status', 1);
    }

}
