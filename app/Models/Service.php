<?php

namespace App\Models;

use App\Libs\Constants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Service.
 *
 * @package namespace App\Models;
 */
class Service extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    const LIST = 'service_list';
    const CREATE = 'service_create';
    const UPDATE = 'service_update';
    const DELETE = 'service_delete';

    const FOLDER_IMAGES = 'services';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'logo',
        'title',
        'slug',
        'description',
        'link',
        'status',
    ];

    protected $appends = ['logo_url', 'icon_url'];
    protected $hidden = ['logo'];

    public function GetLogoUrlAttribute(){
        if (empty($this->logo)) {
            return asset('/images/default.jpg');
        }
        $path = sprintf(self::FOLDER_IMAGES);
        return Storage::disk(Constants::$disk)->url($path . '/' . $this->logo);
    }

    public function GetIconUrlAttribute(){
        $imageUrls = [];
        if ($this->link) {
            $path = sprintf(self::FOLDER_IMAGES);
            foreach ($this->link as $image) {
                $imageUrls[] = Storage::disk(Constants::$disk)->url($path . '/' . $image->icon);
            }
        }
        return $imageUrls;
    }

    public function scopeActive($query){
        return $query->where('status', Constants::$status['active']);
    }
}
