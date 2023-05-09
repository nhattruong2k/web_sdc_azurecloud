<?php
namespace  App\Actions\TeamTeachers;

use App\Cores\Abstracts\Action;
use App\Models\TeamTeachers;
use App\SubActions\Common\UploadImageSubAction;
use Illuminate\Http\Request;
use App\Tasks\TeamTeachers\CreateTeamTeachersTask;
use Illuminate\Support\Str;
use App\Libs\Constants;

class CreateTeachersAction extends Action {

    public function run(Request $request){
        $data = $request->all();
        $data['slug'] = Str::slug($data['fullname'].'-'.$data['profession']);
        $data['status'] = $request['status'] ? Constants::$status['active'] : Constants::$status['deactive'];
        $data['role'] = $request['role'] ? Constants::$person['mentor'] : Constants::$person['teacher'];
        if ($request->hasFile('avatar')){
            $this->handleUploadAvatar($request->file('avatar'), $data);
        }
        $teachers = resolve(CreateTeamTeachersTask::class)->run($data);
        return $teachers;
    }

    private function handleUploadAvatar($file, array &$data)
    {
        $filename = resolve(UploadImageSubAction::class)->run($file, $data['fullname'], TeamTeachers::FOLDER_IMAGES);
        if(!empty($filename)) {
            $data['avatar'] = $filename;
        }
    }
}

?>
