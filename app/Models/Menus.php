<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Menus extends Model
{
    use HasFactory;

    protected $table ='menus';

    const LIST = 'menu_list';
    const CREATE = 'menu_create';
    const UPDATE = 'menu_update';
    const DELETE = 'menu_delete';

    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'status',
        'order_by',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

    ];

    public function parent()
    {
        return $this->belongsTo(Menus::class, 'parent_id');
    }

    public function childrenMenu(){
        return $this->hasMany(Menus::class, 'parent_id', 'id')->with('parent');
    }

    public function scopeActive($q)
    {
        return $q->where('status', 1);
    }

    public function scopeHiddenMenuOfItself($q, $id)
    {
        return $q->where('id', '<>', $id);
    }
}
