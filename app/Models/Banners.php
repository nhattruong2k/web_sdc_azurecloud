<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Banners extends Model
{
    use HasFactory;
    use SoftDeletes;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    const LIST = 'banner_list';
    const CREATE = 'banner_create';
    const UPDATE = 'banner_update';
    const DELETE = 'banner_delete';

    const STORAGE_DISK= "images";
    const FOLDER_IMAGES= "banners";

    protected $fillable = [
        'id',
        'title',
        'link',
        'description',
        'status',
        'url',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

    ];

    protected $appends = [
        'link_urls',
    ];

    public function getLinkUrlAttribute()
    {
        if(empty($this->link)){
            return asset('/images/default.jpg');
        }
        $path = sprintf(self::FOLDER_IMAGES);
        return Storage::disk(self::STORAGE_DISK)->url($path . '/' . $this->link);
    }

    public function getLinkUrlsAttribute()
    {
        return $this->getLinkUrlAttribute();
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
