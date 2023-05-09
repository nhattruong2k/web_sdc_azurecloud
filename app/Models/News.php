<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    use HasFactory, SoftDeletes;

    const LIST = 'news_list';
    const CREATE = 'news_create';
    const UPDATE = 'news_update';
    const DELETE = 'news_delete';


    const STORAGE_DISK= "images";
    const FOLDER_IMAGES= "news";

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'content',
        'image',
        'views',
        'feature',
        'status',
        'user_id',
        'category_id',
        'created_at',
        'keyword',
    ];

    protected $appends = ['image_urls'];
    public function getImageUrlsAttribute()
    {
        if (empty($this->image)) {
            return asset('/images/default.jpg');
        }
        $path = sprintf(self::FOLDER_IMAGES);
        return Storage::disk(self::STORAGE_DISK)->url($path . '/' . $this->image);
    }

    public function categories(){
        return $this->belongsTo(Category::class, 'category_id', 'id')->select('id', 'title');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id')->select('id', 'name');
    }

    public function scopeActive($query){
        return $query->where('status', 1);
    }
}
