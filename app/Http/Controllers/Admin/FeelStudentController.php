<?php

namespace App\Http\Controllers\Admin;

use App\Actions\FeelStudents\CheckExistTitleFeelStudentAction;
use App\Actions\FeelStudents\CreateFeelStudentAction;
use App\Actions\FeelStudents\DestroyImageFeelStudentAction;
use App\Actions\FeelStudents\FindFeelStudentByIdAction;
use App\Actions\FeelStudents\GetPagingFeelStudentAction;
use App\Actions\FeelStudents\UpdateFeelStudentAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeelStudentRequest;
use App\Libs\Constants;
use App\Models\FeelStudent;
use App\Repositories\Contracts\FeelStudentsRepository;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FeelStudentController extends Controller
{
    use DeleteModelTrait;
    protected $_feelStudentRepository;

    public function __construct(FeelStudentsRepository $repository)
    {
        $this->_feelStudentRepository = $repository;
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

        if($request->has('search')){
            $param['search'] = $request->get('search');
        }

        if ($request->has('numpaging') && $request->get('numpaging') > 0) {
            $param['limit'] = $request->get('numpaging');
        }

        $feelStudents = resolve(GetPagingFeelStudentAction::class)->run($param);
        $this->data['title'] = __('feel_students.list');
        $this->data['feelStudents'] = $feelStudents;
        return view('admin.feel_students.index')->with($this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $feelStudent = new FeelStudent();
        $this->data['title'] = __('feel_students.create');
        $this->data['feelStudent'] = $feelStudent;
        return view('admin.feel_students.create')->with($this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeelStudentRequest $request)
    {
        resolve(CreateFeelStudentAction::class)->run($request);
        notify()->success(trans('feel_students.create_successfully'));
        return redirect()->route(FeelStudent::LIST);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feelStudent = resolve(FindFeelStudentByIdAction::class)->run($id);
        $this->data['title'] = __('feel_students.update');
        $this->data['feelStudent'] = $feelStudent;
        return view('admin.feel_students.edit')->with($this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FeelStudentRequest $request, $id)
    {
        resolve(UpdateFeelStudentAction::class)->run($id, $request);
        notify()->success((trans('feel_students.update_successfully')));
        return redirect()->route(FeelStudent::LIST);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = $request->get('id');
        $this->deleteModelTrait($this->_feelStudentRepository, $ids);
        notify()->success((trans('feel_students.delete_successfully')));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active(Request $request) {
        $feelStudent = resolve(FindFeelStudentByIdAction::class)->run($request->get('id'), ['id', 'status']);
        $status = $feelStudent->status == Constants::$status['active'] ? Constants::$status['deactive'] : Constants::$status['active'];
        $this->_feelStudentRepository->update(['status' => $status], $request->get("id"));
        return response()->json(["code" => Response::HTTP_OK, "message" => __('feel_students.status_successfully')]);
    }

    public function deleteImg($id, $imageName){
        resolve(DestroyImageFeelStudentAction::class)->run($id, $imageName);
        return redirect()->back();
    }
}
