<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\DeleteModelTrait;
use App\Exports\ConsultationsExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Actions\Courses\GetAllCourseAction;
use App\Repositories\Contracts\ConsultationRepository;
use App\Actions\Consultations\GetPagingConsultationAction;
use App\Actions\Consultations\UpdateStatusConsultationAction;

class ConsultationController extends Controller
{
    use DeleteModelTrait;
    protected $consultationRepository;

    public function __construct(ConsultationRepository $consultationRepository)
    {
        $this->consultationRepository = $consultationRepository;
    }

    public function index(Request $request){
        $param = array(
            'limit' => 10,
            'sortfield' => 'id',
            'sorttype' => 'DESC'
        );

        if ($request->has('sortfield') && $request->has('sorttype')) {
            $param['sortfield'] = $request->get('sortfield');
            $param['sorttype'] = $request->get('sorttype');
        }

        if ($request->has('search')) {
            $param['search'] = $request->get('search');
        }

        if($request->has('course_id')){
            $param['course'] = $request->get('course_id');
        }

        if ($request->has('numpaging') && $request->get('numpaging') > 0) {
            $param['limit'] = $request->get('numpaging');
        }

        if($request->has('toDate') && $request->has('fromDate')) {
            $param['fromDate'] = $request->get('fromDate');
            $param['toDate'] = $request->get('toDate');
        }
        
        $courses = resolve(GetAllCourseAction::class)->run($request);
        $consultations = resolve(GetPagingConsultationAction::class)->run($param);
        $this->data['title'] = __('consultations.list');
        $this->data['courses'] = $courses;
        $this->data['consultations'] = $consultations;
        return view('admin.consultations.index')->with($this->data)->with(['code' => Response::HTTP_OK,'message' => __('consultations.list')]);
    }

    public function destroy(Request $request){
        $ids = $request->get('id');
        $this->deleteModelTrait($this->consultationRepository,$ids);
        notify()->success(trans('consultations.delete_successfully'));
        LogActivity::addToLog(auth()->user()->name . ' ' . trans('common.delete'));
        return redirect()->back();
    }
    
    public function export(Request $request){
        if ($request->has('search')) {
            $param['search'] = $request->get('search');
        }
        if($request->has('course')){
            $param['course'] = $request->get('course');
        }
        return Excel::download(new ConsultationsExport($request, $param), 'Danh_sach_sinh_vien_dang_ky-'.date("d-m-Y H:i:s").'.xlsx');
    }
    
    public function status(Request $request){
      $status = resolve(UpdateStatusConsultationAction::class)->run($request);
      return response()->json(["status"=>$status,"code" => Response::HTTP_OK, "message" => __('consultations.status_successfully')]);
    }
}
