<?php 
namespace App\Helpers;
use App\Mail\MySendEmail; 
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Mail;
use App\Models\Course;

class Email{
    public static function sendEmailConsultation($data){
        $course = Course::find($data['course_id']);
            $course =  $course ?  $course->getoriginal('title') : '';
            $reviceEmail = config('mail.from.address');
            Mail::to($reviceEmail)->send(new MySendEmail($data,$course));  
     
    }
}

?>