<?php

namespace App\Actions\Works;

use App\Cores\Abstracts\Action;
use App\Models\Work;
use App\SubActions\Common\UploadImageSubAction;
use App\Tasks\Works\FindWorkByIdTask;
use App\Tasks\Works\UpdateWorkTask;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UpdateWorkAction extends Action
{
    public function run(int $id, Request $request)
    {
        $work = resolve(FindWorkByIdTask::class)->run($id);
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
        return resolve(UpdateWorkTask::class)->run($data, $work->id);
    }

    private function handleUploadImage($file, array &$data)
    {
        $filename = resolve(UploadImageSubAction::class)->run($file, $data['slug'], Work::FOLDER_IMAGES);
        if(!empty($filename)) {
            $data['image'] = $filename;
        }
    }
}
