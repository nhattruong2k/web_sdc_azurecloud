<?php
namespace  App\Actions\TeamStudents;

use App\Cores\Abstracts\Action;
use App\Models\TeamStudents;
use App\SubActions\Common\UploadImageSubAction;
use Illuminate\Http\Request;
use App\Tasks\TeamStudents\CreateTeamStudentsTask;
use App\Libs\Constants;
use Illuminate\Support\Str;

class CreateStudentsAction extends Action {

    public function run(Request $request){

        $data = $request->all();
        $data['status'] = $request['status'] ? 1 : 0;
        $data['slug'] = Str::slug($data['fullname'].'-'.$data['position']);
        $data['role'] = Constants::$person['student'];
        if ($request->hasFile('avatar')){
            $this->handleUploadAvatar($request->file('avatar'), $data);
        }
        $students = resolve(CreateTeamStudentsTask::class)->run($data);
        return $students;
    }

    private function handleUploadAvatar($file, array &$data)
    {
        $filename = resolve(UploadImageSubAction::class)->run($file, $data['fullname'], TeamStudents::FOLDER_IMAGES);
        if(!empty($filename)) {
            $data['avatar'] = $filename;
        }
    }
}

?>
