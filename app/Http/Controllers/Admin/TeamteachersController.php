<?php

namespace App\Http\Controllers\Admin;

use App\Actions\TeamTeachers\DestroyImageTeacherAction;
use App\Http\Controllers\Controller;
use App\Models\TeamTeachers;
use Illuminate\Http\Request;
use App\Http\Requests\TeamTeachers\TeachersRequest;
use  App\Actions\TeamTeachers\CreateTeachersAction;
use  App\Actions\TeamTeachers\GetPagingTeachersAction;
use App\Libs\Constants;
use Illuminate\Http\Response;
use App\Repositories\Contracts\TeachersRepository;
use  App\Actions\TeamTeachers\FindTeachersByIdAction;
use  App\Actions\TeamTeachers\UpdateTeachersAction;

class TeamTeachersController extends Controller
{

    protected TeachersRepository $teachersRepository;
    protected TeamTeachers $teacher;
    public function __construct(TeachersRepository $teachersRepository, TeamTeachers $teacher)
    {
        $this->teacher = $teacher;
        $this->teachersRepository = $teachersRepository;
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

        if ($request->has('role')) {
            $param['role'] = $request->get('role');
        }

        if ($request->has('numpaging') && $request->get('numpaging') > 0) {
            $param['limit'] = $request->get('numpaging');
        }
        $teachers = resolve(GetPagingTeachersAction::class)->run($param);
        $this->data['title'] = __('teacher.list');
        $this->data['teachers']=$teachers;
        return view('admin.teachers.index')->with($this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = new TeamTeachers();
        $this->data['title'] = __('teacher.create');
        $this->data['teachers'] = $teachers;
        return view('admin.teachers.create')->with($this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeachersRequest $request)
    {
        resolve(CreateTeachersAction::class)->run($request);
        notify()->success(trans('teacher.create_successfully'));
        return redirect(route(TeamTeachers::LIST));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeamTeachers  $teamteachers
     * @return \Illuminate\Http\Response
     */
    public function show(TeamTeachers $teamteachers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teamteachers  $teamteachers
     * @return \Illuminate\Http\Response
     */
    public function edit(TeamTeachers $teamteachers, $id)
    {
        $teachers =  resolve(FindTeachersByIdAction::class)->run($id);
        $this->data['title'] = __('teacher.update');
        $this->data['teachers'] = $teachers;
        return view('admin.teachers.edit')->with($this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teamteachers  $teamteachers
     * @return \Illuminate\Http\Response
     */
    public function update(TeachersRequest $request, $id)
    {
        resolve(UpdateTeachersAction::class)->run($id, $request);
        notify()->success(trans('teacher.update_successfully'));
        return redirect(route(TeamTeachers::LIST));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teamteachers  $teamteachers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = $request->get('id');
        $arr_ids = explode(",", $ids);
        $this->teacher->whereIn('id', $arr_ids)->delete();
        notify()->success(trans('teacher.delete_successfully'));
        return redirect()->back();
    }

    public function active(Request $request)
    {
        $teachers = resolve(FindTeachersByIdAction::class)->run($request->get('id'), ['id', 'status']);
        $status = $teachers->status == Constants::$status['active'] ? Constants::$status['deactive'] : Constants::$status['active'];
        $this->teachersRepository->update(['status' => $status], $request->get("id"));
        return response()->json(["code" => Response::HTTP_OK, "message" => __('teacher.status_successfully')]);
    }

    public function deleteImg($id, $imageName){
        resolve(DestroyImageTeacherAction::class)->run($id, $imageName);
        return redirect()->back();
    }
}
