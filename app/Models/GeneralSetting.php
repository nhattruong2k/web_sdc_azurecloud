<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class GeneralSetting.
 *
 * @package namespace App\Models;
 */
class GeneralSetting extends Model implements Transformable
{
    use TransformableTrait;

    const VIEW = 'general_setting_view';
    const SAVE = 'general_setting_save';

    const STORAGE_DISK= "images";
    const FOLDER_IMAGES= "settings";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'logo',
        'favicon',
        'thumbnail',
        'name',
        'content_introduce',
        'description',
        'email',
        'phone',
        'address',
        'facebook',
        'facebook_pixel',
        'google_analytics',
        'mailer',
        'host',
        'port',
        'use_name',
        'password',
        'encrytion',
        'from_address',
    ];

    protected $appends = [
        'logo_url',
        'favicon_url',
        'thumbnail_url',
    ];
    protected $hidden = [
        'logo',
        'favicon', 
        'thumbnail',
    ];

    public function getLogoUrlAttribute()
    {
        if (empty($this->logo)) {
            return asset('/images/default.jpg');
        }
        $path = sprintf(self::FOLDER_IMAGES);
        return Storage::disk(self::STORAGE_DISK)->url($path . '/' . $this->logo);
    }

    public function getFaviconUrlAttribute()
    {
        if (empty($this->favicon)) {
            return asset('/images/default.jpg');
        }
        $path = sprintf(self::FOLDER_IMAGES);
        return Storage::disk(self::STORAGE_DISK)->url($path . '/' . $this->favicon);
    }

    public function getThumbnailUrlAttribute()
    {
        if (empty($this->thumbnail)) {
            return asset('/images/default.jpg');
        }
        $path = sprintf(self::FOLDER_IMAGES);
        return Storage::disk(self::STORAGE_DISK)->url($path . '/' . $this->thumbnail);
    }
}
