<?php

namespace App\Http\Controllers\Admin;

use App\Actions\TeamStudents\DestroyImageStudentAction;
use App\Http\Controllers\Controller;
use App\Models\TeamStudents;
use Illuminate\Http\Request;
use App\Actions\TeamStudents\GetPagingStudentsAction;
use App\Actions\TeamStudents\CreateStudentsAction;
use App\Actions\TeamStudents\FindStudentsByIdAction;
use App\Actions\TeamStudents\UpdateStudentsAction;
use App\Http\Requests\TeamStudents\StudentsRequest;
use App\Repositories\Contracts\StudentsRepository;
use App\Libs\Constants;
use Illuminate\Http\Response;

class TeamStudentController extends Controller
{
    protected StudentsRepository $studentRepository;
    protected TeamStudents $student;
    public function __construct(StudentsRepository $studentRepository, TeamStudents $student)
    {
        $this->student = $student;
        $this->studentRepository = $studentRepository;
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
        $students = resolve(GetPagingStudentsAction::class)->run($param);
        $this->data['title'] = __('student.list');
        $this->data['students'] = $students;
        return view('admin.students.index')->with($this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = new TeamStudents();
        $this->data['title'] = __('student.create');
        $this->data['students'] = $students;
        return view('admin.students.create')->with($this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentsRequest $request)
    {
        resolve(CreateStudentsAction::class)->run($request);
        notify()->success(trans('student.create_successfully'));
        return redirect(route(TeamStudents::LIST));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeamStudents  $teamStudents
     * @return \Illuminate\Http\Response
     */
    public function show(TeamStudents $teamStudents)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeamStudents  $teamStudents
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $students =  resolve(FindStudentsByIdAction::class)->run($id);
        $this->data['title'] = __('student.update');
        $this->data['students'] = $students;
        return view('admin.students.edit')->with($this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TeamStudents  $teamStudents
     * @return \Illuminate\Http\Response
     */
    public function update(StudentsRequest $request, $id)
    {
        resolve(UpdateStudentsAction::class)->run($id, $request);
        notify()->success(trans('student.update_successfully'));
        return redirect(route(TeamStudents::LIST));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeamStudents  $teamStudents
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = $request->get('id');
        $arr_ids = explode(",", $ids);
        $this->student->whereIn('id', $arr_ids)->delete();
        notify()->success(trans('student.delete_successfully'));
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $students = resolve(FindStudentsByIdAction::class)->run($request->get('id'), ['id', 'status']);
        $status = $students->status == Constants::$status['active'] ? Constants::$status['deactive'] : Constants::$status['active'];
        $this->studentRepository->update(['status' => $status], $request->get("id"));
        return response()->json(["code" => Response::HTTP_OK, "message" => __('student.status_successfully')]);
    }

    public function deleteImg($id, $imageName){
        resolve(DestroyImageStudentAction::class)->run($id, $imageName);
        return redirect()->back();
    }
}
