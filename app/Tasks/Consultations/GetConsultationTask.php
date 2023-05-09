<?php 
namespace App\Tasks\Consultations;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\ConsultationRepository;

class GetConsultationTask extends Task
{
    protected ConsultationRepository $consultationRepository;

    public function __construct(ConsultationRepository $consultationRepository)
    {
        $this->consultationRepository = $consultationRepository;
    }

    public function run($email, $course){
        return $this->consultationRepository->firstWhere(['email' => $email, 'course_id' => $course]);
    }
}
?>