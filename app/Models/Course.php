<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Course.
 *
 * @package namespace App\Models;
 */
class Course extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    const STORAGE_DISK = 'images';
    const FOLDER_IMAGES = 'courses';

    const LIST = "courses_list";
    const CREATE = "courses_create";
    const UPDATE = "courses_update";
    const DELETE = "courses_delete";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'slug',
        'image',
        'content',
        'description',
        'status',
        'time',
        'degree',
        'object',
        'course_category_id',
        'keyword',
    ];

    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function course_categories(){
        return $this->belongsTo(CourseCategories::class, 'course_category_id', 'id')->select('id', 'title');
    }

    protected $appends = ['image_url'];

    protected $hidden = ['image'];

    public function getImageUrlAttribute()
    {
        if (empty($this->image)) {
            return asset('/images/default.jpg');
        }
        $path = sprintf(self::FOLDER_IMAGES);
        return Storage::disk(self::STORAGE_DISK)->url($path . '/' . $this->image);
    }
}
