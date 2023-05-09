<?php

namespace App\Http\Controllers\Admin;

use App\Actions\statistNumbers\DestroyImageStatistNumberAction;
use App\Http\Controllers\Controller;
use App\Models\StatistNumber;
use Illuminate\Http\Request;
use App\Http\Requests\StatistNumbers\StatistRequest;
use App\Actions\statistNumbers\CreateStatistNumbersAction;
use App\Actions\statistNumbers\GetPagingStatistNumbersAction;
use App\Actions\statistNumbers\FindStatistNumbersByIdAction;
use App\Actions\statistNumbers\UpdateStatistNumbersAction;
use App\Actions\statistNumbers\CheckExistTitleStatistAction;
use App\Traits\DeleteModelTrait;
use App\Repositories\Contracts\StatistNumbersRepository;
use App\Libs\Constants;
use Illuminate\Http\Response;

class StatistNumberController extends Controller
{

    use DeleteModelTrait;
    protected $_idStatusStatistNumbers;
    protected $statisnumbers;

    public function __construct(StatistNumbersRepository $_idStatusStatistNumbers, StatistNumber $statisnumbers)
    {
        $this->_idStatusStatistNumbers = $_idStatusStatistNumbers;
        $this->statisnumbers = $statisnumbers;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $numbers = resolve(GetPagingStatistNumbersAction::class)->run($param);
        $this->data['title'] = __('statistnumber.list');
        $this->data['numbers'] = $numbers;
        return view('admin.statistNumber.index')->with($this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $numbers = new StatistNumber();
        $this->data['title'] = __('statistnumber.create');
        $this->data['numbers'] = $numbers;
        return view('admin.statistNumber.create')->with($this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StatistRequest $request)
    {
        resolve(CreateStatistNumbersAction::class)->run($request);
        notify()->success(trans('statistnumber.create_successfully'));
        return redirect(route(StatistNumber::LIST));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StatistNumber  $statistNumber
     * @return \Illuminate\Http\Response
     */
    public function show(StatistNumber $statistNumber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StatistNumber  $statistNumber
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $numbers =  resolve(FindStatistNumbersByIdAction::class)->run($id);
        $this->data['title'] = __('statistnumber.update');
        $this->data['numbers'] = $numbers;
        return view('admin.statistNumber.edit')->with($this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StatistNumber  $statistNumber
     * @return \Illuminate\Http\Response
     */
    public function update(StatistRequest $request, $id)
    {
        resolve(UpdateStatistNumbersAction::class)->run($id, $request);
        notify()->success(trans('statistnumber.update_successfully'));
        return redirect(route(StatistNumber::LIST));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StatistNumber  $statistNumber
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = $request->get('id');
        $arr_ids = explode(",", $ids);
        $this->statisnumbers->whereIn('id', $arr_ids)->delete();
        notify()->success(trans('statistnumber.delete_successfully'));
        return redirect()->back();
    }

    public function active(Request $request)
    {
        $numbers = resolve(FindStatistNumbersByIdAction::class)->run($request->get('id'), ['id', 'status']);
        $status = $numbers->status == Constants::$status['active'] ? Constants::$status['deactive'] : Constants::$status['active'];
        $this->_idStatusStatistNumbers->update(['status' => $status], $request->get("id"));
        return response()->json(["code" => Response::HTTP_OK, "message" => __('statistnumber.status_successfully')]);
    }

    public function titleExist(Request $request){
        $result = resolve(CheckExistTitleStatistAction::class)->run($request);
        if($result){
            return response()->json(false);
        };
        return response()->json(true);
    }

    public function deleteImg($id, $imageName){
        resolve(DestroyImageStatistNumberAction::class)->run($id, $imageName);
        return redirect()->back();
    }
}
