<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Category extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;


    const LIST = 'category_list';
    const CREATE = 'category_create';
    const UPDATE = 'category_update';
    const DELETE = 'category_delete';


    const STORAGE_DISK= "images";
    const FOLDER_IMAGES= "categories";

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'parent_id',
        'image',
        'order_by',
        'status',
        'is_show_menu',
    ];

    public function category(){
        return $this->hasMany(Category::class);
    }

    public function parentCategory(){
        return $this->belongsTo(Category::class , 'parent_id', 'id');
    }

    public function children(){ //những thằng con category
        return $this->hasMany(Category::class, 'parent_id', 'id')->with('parentCategory');
    }

    public function new(){
        return $this->hasOne(News::class);
    }

    protected $hidden = ['image'];
    protected $appends = ['image_url'];
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

    public function scopeParentCategory($query, $id){
        return $query->where('id','<>', $id);
    }

    public function scopeIsShowMenu($query)
    {
        return $query->where('is_show_menu', 1);
    }
}
