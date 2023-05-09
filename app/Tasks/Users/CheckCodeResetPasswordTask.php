<?php


namespace App\Tasks\Users;


use App\Cores\Abstracts\Task;
use App\Exceptions\NotFoundException;
use App\Repositories\Contracts\PasswordResetRepository;

class CheckCodeResetPasswordTask extends Task
{
    protected PasswordResetRepository $passwordResetRepository;
    public function __construct(PasswordResetRepository $passwordResetRepository) {
        $this->passwordResetRepository = $passwordResetRepository;
    }

    public function run(array $data)
    {
        try {
            $now = date('Y-m-d H:i:s');
            $result = $this->passwordResetRepository->where(['email' => $data['email'],'token' => $data['token']])->where('created_at', '>=', $now)->exists();
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $result;
    }
}
