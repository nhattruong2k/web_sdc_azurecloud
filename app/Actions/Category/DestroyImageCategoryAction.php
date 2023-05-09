<?php


namespace App\Actions\Category;

use App\Cores\Abstracts\Action;
use App\Models\Category;
use App\Tasks\Category\FindCategoryByIdTask;
use App\Tasks\Category\UpdateCategoryTask;
use App\Tasks\Commons\DestroyImageTask;

class DestroyImageCategoryAction extends Action
{
    public function run($id, $imageName){
        resolve(FindCategoryByIdTask::class)->run($id);
        $data['image'] = '';
        $pathFolder = sprintf(Category::FOLDER_IMAGES);
        resolve(DestroyImageTask::class)->run($pathFolder . '/' . $imageName);
        resolve(UpdateCategoryTask::class)->run($data, $id);
        return true;
    }
}
