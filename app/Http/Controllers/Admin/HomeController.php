<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Consultations\CountConsultationAction;
use App\Actions\Courses\CountCourseAction;
use App\Actions\News\CountNewsAction;
use App\Actions\Partners\CountPartnerAction;
use App\Actions\Users\CountUserAction;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        $this->data['count_users'] = resolve(CountUserAction::class)->run();
        $this->data['count_news'] = resolve(CountNewsAction::class)->run();
        $this->data['count_courses'] = resolve(CountCourseAction::class)->run();
        $this->data['count_partners'] = resolve(CountPartnerAction::class)->run();
        $this->data['consultations'] = resolve(CountConsultationAction::class)->run();
        $this->data['title'] = __('common.home');
        return view('admin.home.dashboard')->with($this->data);
    }
}
