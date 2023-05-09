<?php

namespace App\Http\Controllers\Admin;

use App\Actions\ActivityLogs\GetPagingActivityLogAction;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ActivityLogRepository;
use Illuminate\Http\Request;
use App\Traits\DeleteModelTrait;

class ActivityLogController extends Controller
{
    use DeleteModelTrait;
    protected $activityLogRepository;

    public function __construct(ActivityLogRepository $repository)
    {
        $this->activityLogRepository = $repository;
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

        if ($request->has('from_date')) {
            $param['from_date'] = formatDate($request->get('from_date'), 'Y-m-d 00:00:00');
        }

        if ($request->has('to_date')) {
            $param['to_date'] = formatDate($request->get('to_date'), 'Y-m-d 23:59:59');
        }
        $activityLogs = resolve(GetPagingActivityLogAction::class)->run($param);
        $this->data['title'] = __('activity_logs.list');
        $this->data['activityLogs'] = $activityLogs;
        return view('admin.activity_logs.index')->with($this->data);
    }

    public function destroy(Request $request)
    {
        $ids = $request->get('id');
        $this->deleteModelTrait($this->activityLogRepository, $ids);
        notify()->success((trans('activity_logs.delete_succesfully')));
        return redirect()->back();
    }
}
