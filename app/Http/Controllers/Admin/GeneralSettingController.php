<?php

namespace App\Http\Controllers\Admin;

use App\Actions\GeneralSettings\DestroyImageSettingAction;
use App\Actions\GeneralSettings\SaveGeneralSettingAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralSettingRequest;
use App\Models\GeneralSetting;
use App\Repositories\Contracts\GeneralSettingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Prettus\Validator\Exceptions\ValidatorException;

class GeneralSettingController extends Controller
{
    protected $generalSettingRepository;
    public function __construct(GeneralSettingRepository $generalSettingRepository)
    {
        $this->generalSettingRepository = $generalSettingRepository;
    }

    public function index(){
        $general_settings = $this->generalSettingRepository->getFormData() ?? new GeneralSetting();
        $this->data['title'] = trans('general_settings.management');
        $this->data['general_settings'] = $general_settings;
        $this->data['password'] = !empty($general_settings->password) ? Crypt::decryptString($general_settings->password) : '';
        return view('admin.general_settings.form')->with($this->data);
    }

    public function save(GeneralSettingRequest $request){
        resolve(SaveGeneralSettingAction::class)->run($request);
        notify()->success(trans('general_settings.update_successfully'));
        return redirect(route(GeneralSetting::VIEW));
    }
}
