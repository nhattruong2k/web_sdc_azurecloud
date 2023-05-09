<?php


namespace App\Actions\Users;

use App\Cores\Abstracts\Action;
use App\Tasks\Users\CreatePasswordResetTask;
use App\Tasks\Users\FindPasswordResetTask;
use App\Tasks\Users\FindUserByEmailTask;
use App\Tasks\Users\ForgotPasswordTask;
use App\Tasks\Users\UpdatePasswordResetTask;
use Illuminate\Http\Request;

class ForgotPasswordAction extends Action
{
    public function run(Request $request){
        $user = resolve(FindUserByEmailTask::class)->run($request->get('email'), ['name', 'email']);
        if (!$user){
            return $user;
        }
        $date = date('Y-m-d H:i:s');
        $newdate = strtotime ( '+60 minute' , strtotime ( $date ) ) ;
        $newdate = date ( 'Y-m-d H:i:s' , $newdate);
        $data = [
            'email' => $request->get('email'),
            'device' => $request->device,
            'created_at' => $newdate,
        ];
        $data_email = [
            'name' => $user->name,
            'email' => $user->email,
            'subject' => 'Forgot Password',
            'device' => $request->get('device'),
        ];
        if ($request->get('device') == 'web'){
            $token = \Str::random(60) . '.' .base64_encode($user->email);
            $data['token'] = $token;
            $data_email['link'] = route('admin.reset_password', $token);
        }else{
            $code = rand(111111,999999);
            $data['token'] = $code;
            $data_email['code'] = $code;
        }
        $checkExist = resolve(FindPasswordResetTask::class)->run($user->email);
        if ($checkExist){
            resolve(UpdatePasswordResetTask::class)->run($data, $user->email);
        }else{
            resolve(CreatePasswordResetTask::class)->run($data);
        }
        resolve(ForgotPasswordTask::class)->run($data_email, $user->email);
        return true;
    }
}
