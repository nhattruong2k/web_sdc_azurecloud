<?php


namespace App\Actions\News;

use App\Cores\Abstracts\Action;
use App\Models\News;
use App\Tasks\Commons\DestroyImageTask;
use App\Tasks\News\FindNewsByIdTask;
use App\Tasks\News\UpdateNewsTask;

class DestroyImageNewAction extends Action
{
    public function run($id, $imageName){
        resolve(FindNewsByIdTask::class)->run($id);
        $data['image'] = '';
        $pathFolder = sprintf(News::FOLDER_IMAGES);
        resolve(DestroyImageTask::class)->run($pathFolder . '/' . $imageName);
        resolve(UpdateNewsTask::class)->run($data, $id);
        return true;
    }
}
