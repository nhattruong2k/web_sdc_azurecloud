<?php

namespace App\Actions\Works;

use App\Cores\Abstracts\Action;
use App\Models\Work;
use App\SubActions\Common\UploadImageSubAction;
use App\Tasks\Works\CreateWorkTask;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CreateWorkAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);
        if ($request->hasFile('image')){
            $this->handleUploadImage($request->file('image'), $data);
        }

        return resolve(CreateWorkTask::class)->run($data);
    }

    private function handleUploadImage($file, array &$data)
    {
        $filename = resolve(UploadImageSubAction::class)->run($file, $data['slug'], Work::FOLDER_IMAGES);
        if(!empty($filename)) {
            $data['image'] = $filename;
        }
    }
}
