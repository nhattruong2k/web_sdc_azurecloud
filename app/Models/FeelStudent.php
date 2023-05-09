<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class FeelStudent extends Model
{
    use HasFactory, SoftDeletes;

    const LIST = 'feel_students.list';
    const CREATE = 'feel_students.create';
    const UPDATE = 'feel_students.update';
    const DELETE = 'feel_students.delete';

    const STORAGE_DISK= "images";
    const FOLDER_IMAGES= "feel_students";

    protected $fillable = [
        'id',
        'name',
        'content',
        'avatar',
        'status',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'avatar',
    ];

    protected $appends = [
        'avatar_url',
    ];

    public function getAvatarUrlAttribute()
    {
        if(empty($this->avatar)){
            return asset('/images/default.jpg');
        }
        $path = sprintf(self::FOLDER_IMAGES);
        return Storage::disk(self::STORAGE_DISK)->url($path . '/' . $this->avatar);
    }
}
