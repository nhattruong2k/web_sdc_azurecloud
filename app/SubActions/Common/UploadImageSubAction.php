<?php
namespace App\SubActions\Common;

use App\Tasks\Commons\GenerateFileNameTask;
use App\Tasks\Commons\ResizeImageTask;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadImageSubAction
{
    public function run(UploadedFile $file, string $name, $folder, $disk = 'images') : string
    {
        $fileExtension = $file->getClientOriginalExtension();
        $filename = resolve(GenerateFileNameTask::class)->run($name, $fileExtension);
        $path = sprintf($folder);
        $image = resolve(ResizeImageTask::class)->run($file, $fileExtension);
        Storage::disk($disk)->put($path . '/' . $filename, $image);
        return $filename;
    }
}
