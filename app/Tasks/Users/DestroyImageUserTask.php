<?php


namespace App\Tasks\Users;


use App\Cores\Abstracts\Task;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class DestroyImageUserTask extends Task
{
    public function run(string $path){
        Storage::disk(User::STORAGE_DISK)->delete($path);
    }
}
