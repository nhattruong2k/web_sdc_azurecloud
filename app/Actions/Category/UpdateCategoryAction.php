<?php
namespace  App\Actions\Category;

use App\Cores\Abstracts\Action;
use App\Models\Category;
use App\SubActions\Common\UploadImageSubAction;
use App\Tasks\Category\FindCategoryByIdTask;
use Illuminate\Http\Request;
use App\Tasks\Category\UpdateCategoryTask;
use Illuminate\Support\Str;

class UpdateCategoryAction extends Action{
    public function run(int $id, Request $request)
    {
        $category = resolve(FindCategoryByIdTask::class)->run($id);
        $data = $request->all();
        if($request->hasFile('image')){
            $this->handleUploadImage($request->file('image'), $data);
        }else{
            if ($data['remove_img']){
                $data['image'] = '';
            }
        }

        $data['status'] = !empty($data['status']) ? $data['status'] : 0;
        $data['is_show_menu'] = !empty($data['is_show_menu']) ? $data['is_show_menu'] : 0;
        $data['slug'] = Str::slug($data['title']);
        $category = resolve(UpdateCategoryTask::class)->run($data, $category->id);
        return $category;

    }

    private function handleUploadImage($file, array &$data)
    {
        $filename = resolve(UploadImageSubAction::class)->run($file, $data['title'], Category::FOLDER_IMAGES);
        if(!empty($filename)) {
            $data['image'] = $filename;
        }
    }
}

?>
