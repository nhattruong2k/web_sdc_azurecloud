<?php

namespace App\Actions\Courses;

use App\Cores\Abstracts\Action;
use App\Models\Course;
use App\SubActions\Common\UploadImageSubAction;
use App\Tasks\Courses\FindCourseByIdTask;
use App\Tasks\Courses\UpdateCourseTask;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UpdateCourseAction extends Action
{
    public function run(int $id, Request $request)
    {
        $course = resolve(FindCourseByIdTask::class)->run($id);
        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);
        if ($request->hasFile('image')){
            $this->handleUploadImage($request->file('image'), $data);
        }else{
            if ($data['remove_img']){
                $data['image'] = '';
            }
        }
        $data['status'] = !empty($data['status']) ? $data['status'] : 0;
        $course = resolve(UpdateCourseTask::class)->run($data, $course->id);
        return $course;
    }

    private function handleUploadImage($file, array &$data)
    {
        $filename = resolve(UploadImageSubAction::class)->run($file, $data['slug'], Course::FOLDER_IMAGES);
        if(!empty($filename)) {
            $data['image'] = $filename;
        }
    }
}
