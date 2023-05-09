<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Exports\ConsultationsExport;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class Consultation.
 *
 * @package namespace App\Models;
 */
class Consultation extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    const LIST = 'consultation_list';
    const DELETE = 'consultation_delete';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'address',
        'course_id',
        'status',
        'year_of_birth',
        'ip_address',
        'reason',
    ];

    public function course(){
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
