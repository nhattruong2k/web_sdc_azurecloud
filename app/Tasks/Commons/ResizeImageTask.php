<?php

namespace App\Tasks\Commons;

use App\Cores\Abstracts\Task;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ResizeImageTask extends Task
{
    public function run(UploadedFile $file, string $imageExtension = 'jpg', int $width = 0, int $height = 0)
    {
        if ($width || $height) {
            return Image::make($file)->resize($width, $height)->encode($imageExtension);
        }

        return Image::make($file)->encode($imageExtension);
    }
}
