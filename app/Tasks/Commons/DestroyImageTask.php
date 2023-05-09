<?php


namespace App\Tasks\Commons;


use App\Cores\Abstracts\Task;
use Illuminate\Support\Facades\Storage;

class DestroyImageTask extends Task
{
    public function run(string $path, $disk = 'images'){
        Storage::disk($disk)->delete($path);
    }
}
