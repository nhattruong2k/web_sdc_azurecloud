<?php
namespace  App\Actions\Category;

use App\Cores\Abstracts\Action;
use App\Models\Category;
use App\SubActions\Common\UploadImageSubAction;
use Illuminate\Http\Request;
use App\Tasks\Category\CreateCategoryTask;
use Illuminate\Support\Str;

class CreateCategoryAction extends Action {

    public function run(Request $request){
        $data = $request->all();
        $data['status'] = $request['status'] ? 1 : 0;
        $data['is_show_menu'] = $request['is_show_menu'] ? 1 : 0;
        $data['slug'] = Str::slug($data['title']);
        if ($request->hasFile('image')){
            $this->handleUploadImage($request->file('image'), $data);
        }
        $category = resolve(CreateCategoryTask::class)->run($data);
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
