<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Projectstudents\CheckExistTitleProjectStudentAction;
use App\Actions\Projectstudents\CreateProjectStudentAction;
use App\Actions\Projectstudents\DestroyImageProjectStudentAction;
use App\Actions\Projectstudents\FindProjectStudentByIdAction;
use App\Actions\Projectstudents\GetPagingProjectStudentAction;
use App\Actions\Projectstudents\UpdateProjectStudentAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectStudentRequest;
use App\Libs\Constants;
use App\Models\ProjectStudent;
use App\Repositories\Contracts\ProjectStudentsRepository;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectStudentController extends Controller
{
    use DeleteModelTrait;
    protected $_projectStudentsRepository;

    public function __construct(ProjectStudentsRepository $repository)
    {
        $this->_projectStudentsRepository = $repository;
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
        $projectStudents = resolve(GetPagingProjectStudentAction::class)->run($param);
        $this->data['title'] = __('project_students.list');
        $this->data['projectStudents'] = $projectStudents;
        return view('admin.project_students.index')->with($this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projectStudent = new ProjectStudent();
        $this->data['title'] = __('project_students.create');
        $this->data['projectStudent'] = $projectStudent;
        return view('admin.project_students.create')->with($this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectStudentRequest $request)
    {
        resolve(CreateProjectStudentAction::class)->run($request);
        notify()->success(trans('project_students.create_successfully'));
        return redirect()->route(ProjectStudent::LIST);
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
        $projectStudent = resolve(FindProjectStudentByIdAction::class)->run($id);
        $this->data['title'] = __('project_students.update');
        $this->data['projectStudent'] = $projectStudent;
        return view('admin.project_students.edit')->with($this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectStudentRequest $request, $id)
    {
        resolve(UpdateProjectStudentAction::class)->run($id, $request);
        notify()->success((trans('project_students.update_successfully')));
        return redirect()->route(ProjectStudent::LIST);
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
        $this->deleteModelTrait($this->_projectStudentsRepository, $ids);
        notify()->success((trans('project_students.delete_successfully')));
        return redirect()->back();
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active(Request $request)
    {
        $projectStudent = resolve(FindProjectStudentByIdAction::class)->run($request->get('id'), ['id', 'status']);
        $status = $projectStudent->status == Constants::$status['active'] ? Constants::$status['deactive'] : Constants::$status['active'];
        $this->_projectStudentsRepository->update(['status' => $status], $request->get("id"));
        return response()->json(["code" => Response::HTTP_OK, "message" => __('project_students.status_successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function titleExist (Request $request)
    {
        $result = resolve(CheckExistTitleProjectStudentAction::class)->run($request);
        if($result){
            return response()->json(false);
        };
        return response()->json(true);
    }

    public function deleteImg($id, $imageName){
        resolve(DestroyImageProjectStudentAction::class)->run($id, $imageName);
        return redirect()->back();
    }
}
