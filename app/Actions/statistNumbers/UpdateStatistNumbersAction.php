<?php
namespace App\Actions\statistNumbers;

use App\Cores\Abstracts\Action;
use App\Models\StatistNumber;
use App\SubActions\Common\UploadImageSubAction;
use App\Tasks\StatistNumbers\FindStatistNumbersByIdTask;
use Illuminate\Http\Request;
use App\Tasks\StatistNumbers\UpdateStatistNumbersTask;

class UpdateStatistNumbersAction extends Action{
    public function run(int $id, Request $request)
    {
        $numbers = resolve(FindStatistNumbersByIdTask::class)->run($id);
        $data = $request->all();
        $data['link'] = empty($request['link']) ? "#" : " ";
        $data['status'] = $request['status'] ? 1 : 0;
        if ($request->hasFile('icon')){
            $this->handleUploadIcon($request->file('icon'), $data);
        }
        $numbers = resolve(UpdateStatistNumbersTask::class)->run($data, $numbers->id);
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
