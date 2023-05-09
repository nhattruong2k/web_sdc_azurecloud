<?php

namespace App\Actions\Courses;

use App\Cores\Abstracts\Action;
use App\Models\Course;
use App\SubActions\Common\UploadImageSubAction;
use App\Tasks\Courses\CreateCourseTask;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CreateCourseAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);
        if ($request->hasFile('image')){
            $this->handleUploadImage($request->file('image'), $data);
        }
        $course = resolve(CreateCourseTask::class)->run($data);
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
