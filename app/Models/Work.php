<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Work extends Model
{
    use HasFactory, SoftDeletes;

    const LIST = 'work_list';
    const CREATE = 'work_create';
    const UPDATE = 'work_update';
    const DELETE = 'work_delete';

    const STORAGE_DISK= "images";
    const FOLDER_IMAGES= "works";

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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'image_url'
    ];

    protected $hidden = [
        'image'
    ];

    public function getImageUrlAttribute()
    {
        if (empty($this->image)) {
            return asset('/images/default.jpg');
        }
        $path = sprintf(self::FOLDER_IMAGES);
        return Storage::disk(self::STORAGE_DISK)->url($path . '/' . $this->image);
    }

    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function courseCategory()
    {
        return $this->belongsTo(CourseCategories::class, 'course_category_id', 'id')->select('id', 'title', 'image');
    }
}
