<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Storage;

class Cache {
    public static function read($fileName) {
        if (file_exists(Storage::path($fileName))) {
            $data = Storage::get($fileName);
            return json_decode($data);
        }
        return false;
    }
    public static function write($fileName, $variable) {
        Storage::put($fileName, $variable);
    }

    public static function delete($fileName) {
        Storage::delete($fileName);
    }
}
?>