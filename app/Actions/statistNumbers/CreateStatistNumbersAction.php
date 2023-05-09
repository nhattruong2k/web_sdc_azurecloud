<?php
namespace  App\Actions\statistNumbers;

use App\Cores\Abstracts\Action;
use App\Models\StatistNumber;
use App\SubActions\Common\UploadImageSubAction;
use Illuminate\Http\Request;
use App\Tasks\StatistNumbers\CreateStatistNumbersTask;

class CreateStatistNumbersAction extends Action {

    public function run(Request $request){
        $data = $request->all();
        $data['link'] = empty($request['link']) ? "#" : " ";
        $data['status'] = $request['status'] ? 1 : 0;
        if ($request->hasFile('icon')){
            $this->handleUploadIcon($request->file('icon'), $data);
        }
        $numbers = resolve(CreateStatistNumbersTask::class)->run($data);
        return $numbers;
    }

    private function handleUploadIcon($file, array &$data)
    {
        $filename = resolve(UploadImageSubAction::class)->run($file, $data['title'], StatistNumber::FOLDER_ICONS);
        if(!empty($filename)) {
            $data['icon'] = $filename;
        }
    }
}

?>
