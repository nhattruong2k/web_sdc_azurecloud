<?php
namespace  App\Actions\News;

use App\Cores\Abstracts\Action;
use App\Models\News;
use App\SubActions\Common\UploadImageSubAction;
use Illuminate\Http\Request;
use App\Tasks\News\CreateNewsTask;
use Illuminate\Support\Str;
class CreateNewsAction extends Action {

    public function run(Request $request){
        $data = $request->all();
        $data['created_at'] = $request['created_at']." ".date("H:i:s");
        $data['slug'] = Str::slug($data['title']);
        $data['status'] = $request['status'] ? 1 : 0;
        $data['user_id'] = auth()->user()->id;
        $data['feature'] = $request['feature'] ? 1 : 0;
        if ($request->hasFile('image')){
            $this->handleUploadImage($request->file('image'),$data);
        }
        $news = resolve(CreateNewsTask::class)->run($data);
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
