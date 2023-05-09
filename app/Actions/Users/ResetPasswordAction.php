<?php


namespace App\Actions\Users;

use App\Cores\Abstracts\Action;
use App\Tasks\Users\CheckCodeResetPasswordTask;
use App\Tasks\Users\UpdatePasswordTask;
use Illuminate\Http\Request;

class ResetPasswordAction extends Action
{
    public function run(Request $request, $token = null){
        $dataUpdate['password'] = bcrypt($request->get('password'));
        $code = explode('.', $token);
        if (!$token){
            $data = [
                'token' => $request->code,
                'email' => $request->email,
            ];
        }else{
            $data = [
                'token' => $token,
                'email' => base64_decode($code[1]),
            ];
        }
        $checkCode = resolve(CheckCodeResetPasswordTask::class)->run($data);
        if ($checkCode){
            resolve(UpdatePasswordTask::class)->run($dataUpdate, $data['email']);
        }
        return $checkCode;

    }
}
