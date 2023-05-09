<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Partners extends Model
{
    use HasFactory, SoftDeletes;

    const LIST = 'partners_list';
    const CREATE = 'partners_create';
    const UPDATE = 'partners_update';
    const DELETE = 'partners_delete';

    const STORAGE_DISK= "images";
    const FOLDER_IMAGES= "partners";

    protected $fillable = [
        'id',
        'title',
        'image',
        'description',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    protected $appends = [
        'image_url',
    ];

    public function getImageUrlAttribute()
    {
        if(empty($this->image)){
            return asset('/images/default.jpg');
        }
        $path = sprintf(self::FOLDER_IMAGES);
        return Storage::disk(self::STORAGE_DISK)->url($path . '/' . $this->image);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
