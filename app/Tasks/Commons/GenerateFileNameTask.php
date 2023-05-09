<?php

namespace App\Tasks\Commons;

use App\Cores\Abstracts\Task;

class GenerateFileNameTask extends Task
{
    public function run(string $name, string $fileExtension) : string
    {
        $milliseconds = floor(microtime(true) * 1000);
        return generatorString($name) . '-' . $milliseconds . '.' . $fileExtension;
    }
}
