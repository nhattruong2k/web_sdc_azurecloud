<?php
namespace  App\Actions\Services;

use App\Cores\Abstracts\Action;
use App\Models\Service;
use App\SubActions\Common\UploadImageSubAction;
use App\Tasks\Services\CreateServiceTask;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CreateServiceAction extends Action {

    public function run(Request $request){
        $data = $request->all();
        $data['status'] = $request['status'] ? 1 : 0;
        $data['slug'] = Str::slug($data['title']);
        for ($i = 0; $i < count($data['names']); $i++){
            $icon = $this->handleUploadIcon($data['icons'][$i], $data['names'][$i]);
            $datas[$i]['icon'] = $icon;
            $datas[$i]['name'] = $data['names'][$i];
            $datas[$i]['url'] = $data['urls'][$i];
        }
        $data['link'] = json_encode($datas);
        if ($request->hasFile('logo')){
            $this->handleUploadLogo($request->file('logo'), $data);
        }
        return resolve(CreateServiceTask::class)->run($data);
    }

    private function handleUploadLogo($file, array &$data)
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
