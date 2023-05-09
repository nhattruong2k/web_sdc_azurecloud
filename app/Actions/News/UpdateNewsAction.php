<?php
namespace  App\Actions\News;

use App\Cores\Abstracts\Action;
use App\Models\News;
use App\SubActions\Common\UploadImageSubAction;
use App\Tasks\News\FindIdByContentNewsTask;
use Illuminate\Http\Request;
use App\Tasks\News\UpdateNewsTask;
use Illuminate\Support\Str;

class UpdateNewsAction extends Action{
    public function run(int $id, Request $request)
    {
        $news = resolve(FindIdByContentNewsTask::class)->run($id);
        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);
        if($request->hasFile('image')){
            $this->handleUploadImage($request->file('image'), $data);
        }
        $data['status'] = !empty($data['status']) ? $data['status'] : 0;
        $data['feature'] = !empty($data['feature']) ? $data['feature'] : 0;
        $data['created_at'] = $request['created_at']." ".date("H:i:s");
        $news = resolve(UpdateNewsTask::class)->run($data, $news->id);
        return $news;
    }

    private function handleUploadImage($file, array &$data)
    {
        $filename = resolve(UploadImageSubAction::class)->run($file, $data['slug'], News::FOLDER_IMAGES);
        if(!empty($filename)) {
            $data['image'] = $filename;
        }
    }
}

?>
