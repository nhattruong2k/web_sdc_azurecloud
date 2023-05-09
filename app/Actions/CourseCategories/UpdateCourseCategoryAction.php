<?php
namespace  App\Actions\CourseCategories;

use App\Cores\Abstracts\Action;
use App\Models\CourseCategories;
use App\SubActions\Common\UploadImageSubAction;
use App\Tasks\CourseCategories\FindCourseCategoryByIdTask;
use App\Tasks\CourseCategories\UpdateCourseCategoryTask;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UpdateCourseCategoryAction extends Action{
    public function run(int $id, Request $request)
    {
        $course_category = resolve(FindCourseCategoryByIdTask::class)->run($id);
        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);
        if($request->hasFile('image')){
            $this->handleUploadImage($request->file('image'), $data);
        }else{
            if ($data['remove_img']){
                $data['image'] = '';
            }
        }
        $data['status'] = !empty($data['status']) ? $data['status'] : 0;
        $data['parent_id'] = $data['parent_id'] ?? 0;
        return resolve(UpdateCourseCategoryTask::class)->run($data, $course_category->id);
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
