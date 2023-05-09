<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Benefit extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'benefit_students';

    const LIST = 'benefit_students_list';
    const CREATE = 'benefit_students_create';
    const UPDATE = 'benefit_students_update';
    const DELETE = 'benefit_students_delete';

    const STORAGE_DISK= "images";
    const FOLDER_IMAGES= "benefits";

    protected $fillable = [
        'id',
        'title',
        'content',
        'icon',
        'image',
        'status',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'image',
        'icon',
    ];

    protected $appends = [
        'image_url',
        'icon_url',
    ];

    public function getImageUrlAttribute()
    {
        if(empty($this->image)){
            return asset('/images/default.jpg');
        }
        $path = sprintf(self::FOLDER_IMAGES);
        return Storage::disk(self::STORAGE_DISK)->url($path . '/' . $this->image);
    }

    public function getIconUrlAttribute()
    {
        if(empty($this->icon)){
            return asset('/images/default.jpg');
        }
        $path = sprintf(self::FOLDER_IMAGES);
        return Storage::disk(self::STORAGE_DISK)->url($path . '/' . $this->icon);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
