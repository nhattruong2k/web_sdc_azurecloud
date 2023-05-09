<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use  App\Libs\Constants;

class TeamTeachers extends Model
{
    use HasFactory, SoftDeletes;

    protected $table ='persons';

    const LIST = 'teacher_list';
    const CREATE = 'teacher_create';
    const UPDATE = 'teacher_update';
    const DELETE = 'teacher_delete';


    const STORAGE_DISK= "images";
    const FOLDER_IMAGES= "teachers";

    protected $fillable = [
       'fullname',
       'slug',
       'avatar',
       'profession',
       'role',
       'description',
       'status',
    ];

    protected $hidden = ['avatar', 'skills', 'position', 'workplace'];
    protected $appends = ['avatar_urls'];
    public function getAvatarUrlsAttribute()
    {
        if (empty($this->avatar)) {
            return asset('/images/default.jpg');
        }
        $path = sprintf(self::FOLDER_IMAGES);
        return Storage::disk(self::STORAGE_DISK)->url($path . '/' . $this->avatar);
    }

    public function scopeActive($query)
    {
        return $query->where('status',Constants::$status['active']);
    }

    public function scopeRoleTeachers($query){
        return $query->whereIn('role',[Constants::$person['teacher'], Constants::$person['mentor']]);
    }
}
?>
