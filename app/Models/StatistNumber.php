<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use  App\Libs\Constants;

class StatistNumber extends Model
{
    use HasFactory, SoftDeletes;
    protected $table ='statist_numbers';

    const LIST = 'statistNumber_list';
    const CREATE = 'statistNumber_create';
    const UPDATE = 'statistNumber_update';
    const DELETE = 'statistNumber_delete';


    const STORAGE_DISK= "images";
    const FOLDER_ICONS= "statistNumbers";


    protected $fillable = [
        'title', 'figures','icon','link','status',
    ];

    protected $appends = ['icon_urls'];
    public function getIconUrlsAttribute()
    {
        if (empty($this->icon)) {
            return asset('/images/default.jpg');
        }
        $path = sprintf(self::FOLDER_ICONS);
        return Storage::disk(self::STORAGE_DISK)->url($path . '/' . $this->icon);
    }

    public function scopeActive($query){
        return $query->where('status',Constants::$status['active']);
    }
}
