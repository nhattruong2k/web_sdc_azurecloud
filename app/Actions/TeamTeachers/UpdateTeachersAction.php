<?php
namespace  App\Actions\TeamTeachers;

use App\Cores\Abstracts\Action;
use App\Models\TeamTeachers;
use App\SubActions\Common\UploadImageSubAction;
use App\Tasks\TeamTeachers\FindTeachersByIdTask;
use Illuminate\Http\Request;
use  App\Tasks\TeamTeachers\UpdateTeachersTask;
use App\Libs\Constants;
use Illuminate\Support\Str;

class UpdateTeachersAction extends Action{
    public function run(int $id, Request $request)
    {
        $teachers = resolve(FindTeachersByIdTask::class)->run($id);
        $data = $request->all();
        $data['slug'] = Str::slug($data['fullname'].'-'.$data['profession']);
        $data['status'] = $request['status'] ? Constants::$status['active'] : Constants::$status['deactive'];
        $data['role'] = $request['role'] ? Constants::$person['mentor'] : Constants::$person['teacher'];
        if ($request->hasFile('avatar')){
            $this->handleUploadAvatar($request->file('avatar'), $data);
        }else{
            if ($data['remove_img']){
                $data['avatar'] = '';
            }
        }
        $teachers = resolve(UpdateTeachersTask::class)->run($data, $teachers->id);
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
