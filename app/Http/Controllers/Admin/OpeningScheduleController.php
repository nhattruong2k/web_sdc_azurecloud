<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Courses\GetPluckCourseAction;
use App\Actions\OpeningSchedules\CheckExistOpeningScheduleAction;
use App\Actions\OpeningSchedules\CreateOpeningScheduleAction;
use App\Actions\OpeningSchedules\FindOpeningScheduleByIdAction;
use App\Actions\OpeningSchedules\GetPagingOpeningScheduleAction;
use App\Actions\OpeningSchedules\UpdateOpeningScheduleAction;
use App\Actions\Users\GetPluckUserAction;
use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Http\Requests\OpeningScheduleRequest;
use App\Libs\Constants;
use App\Models\OpeningSchedule;
use App\Repositories\Contracts\OpeningScheduleRepository;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OpeningScheduleController extends Controller
{
    use DeleteModelTrait;
    protected $openingScheduleRepository;

    public function __construct(OpeningScheduleRepository $openingScheduleRepository)
    {
        $this->openingScheduleRepository = $openingScheduleRepository;
    }

    public function index(Request $request)
    {
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

        if ($request->has('numpaging') && $request->get('numpaging') > 0) {
            $param['limit'] = $request->get('numpaging');
        }
        $opening_schedules = resolve(GetPagingOpeningScheduleAction::class)->run($param);
        $this->data['title'] = __('opening_schedules.list');
        $this->data['opening_schedules'] = $opening_schedules;
        return view('admin.opening_schedules.index')->with($this->data)->with(['code' => Response::HTTP_OK,'message' => __('opening_schedules.list')]);
    }

    public function create()
    {
        $opening_schedule = new OpeningSchedule();
        $courses = resolve(GetPluckCourseAction::class)->run();
        $users = resolve(GetPluckUserAction::class)->run();
        $this->data['title'] = __('opening_schedules.create');
        $this->data['opening_schedule'] = $opening_schedule;
        $this->data['courses'] = $courses;
        $this->data['users'] = $users;
        return view('admin.opening_schedules.create')->with($this->data);
    }

    public function store(OpeningScheduleRequest $request)
    {
        resolve(CreateOpeningScheduleAction::class)->run($request);
        notify()->success(trans('opening_schedules.create_successfully'));
        LogActivity::addToLog(auth()->user()->name. ' ' . trans("common.add"), trans("opening_schedules.create"), $request->all());
        return redirect(route(OpeningSchedule::LIST));
    }

    public function edit($id)
    {
        $opening_schedule =  resolve(FindOpeningScheduleByIdAction::class)->run($id);
        $courses = resolve(GetPluckCourseAction::class)->run();
        $users = resolve(GetPluckUserAction::class)->run();
        $this->data['title'] = __('opening_schedules.update');
        $this->data['opening_schedule'] = $opening_schedule;
        $this->data['courses'] = $courses;
        $this->data['users'] = $users;
        return view('admin.opening_schedules.edit')->with($this->data);
    }

    public function update(OpeningScheduleRequest $request, $id)
    {
        resolve(UpdateOpeningScheduleAction::class)->run($id, $request);
        notify()->success(trans('opening_schedules.update_successfully'));
        LogActivity::addToLog(auth()->user()->name. ' ' . trans("common.update"), trans("opening_schedules.update"), $request->all());
        return redirect(route(OpeningSchedule::LIST));
    }

    public function destroy(Request $request)
    {
        $ids = $request->get('id');
        $this->deleteModelTrait($this->openingScheduleRepository,$ids);
        notify()->success(trans('opening_schedules.delete_successfully'));
        LogActivity::addToLog(auth()->user()->name. ' ' . trans("common.delete"), trans("opening_schedules.delete"));
        return redirect()->back();
    }

    public function active(Request $request) {
        $opening_schedule = resolve(FindOpeningScheduleByIdAction::class)->run($request->get('id'), ['id', 'status']);
        $status = $opening_schedule->status == Constants::$status['active'] ? Constants::$status['deactive'] : Constants::$status['active'];
        $this->openingScheduleRepository->update(['status' => $status], $request->get("id"));
        return response()->json(["code" => Response::HTTP_OK, "message" => __('common.status_successfully')]);
    }

    public function exist(Request $request){
        $result = resolve(CheckExistOpeningScheduleAction::class)->run($request);
        if($result){
            return response()->json(false);
        };
        return response()->json(true);
    }
}
