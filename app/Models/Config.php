<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Config extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'config';

    const LIST = 'config_list';
    const CREATE = 'config_create';
    const UPDATE = 'config_update';
    const DELETE = 'config_delete';

    protected $fillable = [
        'id',
        'key',
        'value',
        'status',
    ];

    public function scopeActive($q)
    {
        return $q->where('status', 1);
    }
}
