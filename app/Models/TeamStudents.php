<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class TeamStudents extends Model
{
    use HasFactory, SoftDeletes;

    protected $table ='persons';

    const LIST = 'student_list';
    const CREATE = 'student_create';
    const UPDATE = 'student_update';
    const DELETE = 'student_delete';


    const STORAGE_DISK= "images";
    const FOLDER_IMAGES= "students";

    protected $fillable = [
       'fullname',
       'slug',
       'avatar',
       'position',
       'workplace',
       'role',
       'description',
       'status',
    ];

    protected $appends = ['avatar_urls'];
    public function getAvatarUrlsAttribute()
    {
        if (empty($this->avatar)) {
            return asset('/images/default.jpg');
        }
        $path = sprintf(self::FOLDER_IMAGES);
        return Storage::disk(self::STORAGE_DISK)->url($path . '/' . $this->avatar);
    }

    public function scopeRoleStudents($query){
        return $query->where('role', 1);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeStudent($query)
    {
        return $query->where('role', 1);
    }
}
?>
