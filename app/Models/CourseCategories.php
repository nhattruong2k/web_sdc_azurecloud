<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class CourseCategories.
 *
 * @package namespace App\Models;
 */
class CourseCategories extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;


    const LIST = "course_categories_list";
    const CREATE = "course_categories_create";
    const UPDATE = "course_categories_update";
    const DELETE = "course_categories_delete";

    const STORAGE_DISK= "images";
    const FOLDER_IMAGES= "course_categories";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'slug',
        'summary',
        'parent_id',
        'image',
        'order',
        'status',
    ];

    public function scopeActive($query){
        return $query->where('status', 1);
    }

    protected $hidden = ['image'];
    protected $appends = [
        'image_url'
    ];

    public function getImageUrlAttribute()
    {
        if (empty($this->image)) {
            return asset('/images/default.jpg');
        }
        $path = sprintf(self::FOLDER_IMAGES);
        return Storage::disk(self::STORAGE_DISK)->url($path . '/' . $this->image);
    }

    public function parentCourseCategory(){
        return $this->belongsTo(CourseCategories::class , 'parent_id', 'id');
    }

    public function works()
    {
        return $this->hasMany(Work::class, 'course_category_id');
    }
    public function scopeRemoveId($query, $id){
        return $query->where('parent_id', '<>', $id)->where('id', '<>', $id);
    }

    public function courses(array $columns)
    {
        return $this->hasMany(Course::class, 'course_category_id', 'id')->select($columns);
    }
}
