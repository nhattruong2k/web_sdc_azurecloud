<?php
namespace  App\Actions\CourseCategories;

use App\Cores\Abstracts\Action;
use App\Models\CourseCategories;
use App\SubActions\Common\UploadImageSubAction;
use App\Tasks\CourseCategories\CreateCourseCategoryTask;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CreateCourseCategoryAction extends Action {

    public function run(Request $request){
        $data = $request->all();
        $data['status'] = $request['status'] ? 1 : 0;
        $data['slug'] = Str::slug($data['title']);
        if ($request->hasFile('image')){
            $this->handleUploadImage($request->file('image'), $data);
        }
        return resolve(CreateCourseCategoryTask::class)->run($data);
    }

    private function handleUploadImage($file, array &$data)
    {
        $filename = resolve(UploadImageSubAction::class)->run($file, $data['slug'], CourseCategories::FOLDER_IMAGES);
        if(!empty($filename)) {
            $data['image'] = $filename;
        }
    }
}

?>
