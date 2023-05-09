<?php
namespace App\Actions\TeamStudents;

use App\Cores\Abstracts\Action;
use App\Models\TeamStudents;
use App\SubActions\Common\UploadImageSubAction;
use App\Tasks\TeamStudents\FindStudentsByIdTask;
use Illuminate\Http\Request;
use  App\Tasks\TeamStudents\UpdateStudentsTask;
use App\Libs\Constants;
use Illuminate\Support\Str;

class UpdateStudentsAction extends Action{
    public function run(int $id, Request $request)
    {
        $students = resolve(FindStudentsByIdTask::class)->run($id);
        $data = $request->all();
        $data['status'] = $request['status'] ? 1 : 0;
        $data['slug'] = Str::slug($data['fullname'].'-'.$data['position']);
        $data['role'] = Constants::$person['student'];
        if ($request->hasFile('avatar')){
            $this->handleUploadAvatar($request->file('avatar'), $data);
        }else{
            if ($data['remove_img']){
                $data['image'] = '';
            }
        }
        $students = resolve(UpdateStudentsTask::class)->run($data, $students->id);
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
