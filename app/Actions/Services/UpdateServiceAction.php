<?php
namespace  App\Actions\Services;

use App\Cores\Abstracts\Action;
use App\Models\CourseCategories;
use App\Models\Service;
use App\SubActions\Common\UploadImageSubAction;
use App\Tasks\CourseCategories\UpdateCourseCategoryTask;
use App\Tasks\Services\FindServiceByIdTask;
use App\Tasks\Services\UpdateServiceTask;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UpdateServiceAction extends Action{
    public function run(int $id, Request $request)
    {
        $service = resolve(FindServiceByIdTask::class)->run($id);
        $link = json_decode($service->link);
        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);
        for ($i = 0; $i < count($data['names']); $i++){
            if (isset($data['icons'][$i])){
                $icon = $this->handleUploadIcon($data['icons'][$i], $data['names'][$i]);
                $datas[$i]['icon'] = $icon;
            }else{
                $datas[$i]['icon'] = $link[$i]->icon;
            }
            $datas[$i]['name'] = $data['names'][$i];
            $datas[$i]['url'] = $data['urls'][$i];
        }
        $data['link'] = json_encode($datas);
        if($request->hasFile('logo')){
            $this->handleUploadImage($request->file('logo'), $data);
        }
        $data['status'] = !empty($data['status']) ? $data['status'] : 0;
        return resolve(UpdateServiceTask::class)->run($data, $service->id);
    }

    private function handleUploadImage($file, array &$data)
    {
        $filename = resolve(UploadImageSubAction::class)->run($file, $data['slug'], Service::FOLDER_IMAGES);
        if(!empty($filename)) {
            $data['logo'] = $filename;
        }
    }

    private function handleUploadIcon($file, $name)
    {
        $filename = resolve(UploadImageSubAction::class)->run($file, $name, Service::FOLDER_IMAGES);
        if(!empty($filename)) {
            return $filename;
        }
    }
}

?>
