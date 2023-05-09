<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Cache;
use App\Models\Course;
use App\Libs\Constants;
use App\Helpers\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\DeleteModelTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Actions\Courses\CreateCourseAction;
use App\Actions\Courses\UpdateCourseAction;
use App\Actions\Courses\FindCourseByIdAction;
use App\Actions\Courses\GetPagingCourseAction;
use App\Repositories\Contracts\CourseRepository;
use App\Actions\Courses\DestroyImageCourseAction;
use App\Actions\Courses\CheckTitleExistCourseAction;
use App\Actions\CourseCategories\GetAllCourseCategoryAction;
use App\Actions\CourseCategories\GetTreeCourseCategoryAction;
use App\Tasks\OpeningSchedules\CheckExistOpeningScheduleTask;

class CourseController extends Controller
{
    use DeleteModelTrait;
    protected $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
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

        if($request->has('category_course_id')){
            $param['category_course'] = $request->get('category_course_id');
        }

        if ($request->has('numpaging') && $request->get('numpaging') > 0) {
            $param['limit'] = $request->get('numpaging');
        }
        $courses = resolve(GetPagingCourseAction::class)->run($param);
        $category_course =  resolve(GetAllCourseCategoryAction::class)->run();
        $this->data['title'] = __('courses.list');
        $this->data['courses'] = $courses;
        $this->data['category_course']= $category_course;
        return view('admin.courses.index')->with($this->data)->with(['code' => Response::HTTP_OK,'message' => __('courses.list')]);
    }

    public function create()
    {
        $course = new Course();
        $courseCategories = resolve(GetTreeCourseCategoryAction::class)->run();
        $this->data['title'] = __('courses.create');
        $this->data['course'] = $course;
        $this->data['courseCategories'] = $courseCategories;
        return view('admin.courses.create')->with($this->data);
    }

    public function store(CourseRequest $request)
    {
        resolve(CreateCourseAction::class)->run($request);
        notify()->success(trans('courses.create_successfully'));
        LogActivity::addToLog(auth()->user()->name. ' ' . trans("common.create"), trans("courses.create"), $request->all());
        return redirect(route(Course::LIST));
    }

    public function edit($id)
    {
        $course =  resolve(FindCourseByIdAction::class)->run($id);
        $courseCategories = resolve(GetTreeCourseCategoryAction::class)->run($course->course_category_id);
        $this->data['title'] = __('courses.update');
        $this->data['course'] = $course;
        $this->data['courseCategories'] = $courseCategories;
        return view('admin.courses.edit')->with($this->data)->with(['code' => Response::HTTP_OK,'message' => __('courses.update')]);
    }

    public function update(CourseRequest $request, $id)
    {
        resolve(UpdateCourseAction::class)->run($id, $request);
        notify()->success(trans('courses.update_successfully'));
        LogActivity::addToLog(auth()->user()->name. ' ' . trans("common.update"), trans("courses.update"), $request->all());
        return redirect(route(Course::LIST));
    }

    public function destroy(Request $request)
    {
        $ids = $request->get('id');
        $exist = resolve(CheckExistOpeningScheduleTask::class)->run($ids);
        if ($exist){
            notify()->error(trans('courses.delete_error'));
            return redirect()->back();
        }
        $this->deleteModelTrait($this->courseRepository,$ids);
        Cache::delete(Constants::$fileName['course']);
        notify()->success(trans('courses.delete_successfully'));
        LogActivity::addToLog(auth()->user()->name. ' ' . trans("common.delete"), trans("courses.delete"));
        return redirect()->back();
    }

    public function active(Request $request) {
        $course = resolve(FindCourseByIdAction::class)->run($request->get('id'), ['id', 'status']);
        $status = $course->status == Constants::$status['active'] ? Constants::$status['deactive'] : Constants::$status['active'];
        $this->courseRepository->update(['status' => $status], $request->get("id"));
        return response()->json(["code" => Response::HTTP_OK, "message" => __('courses.status_successfully')]);
    }

    public function titleExist(Request $request){
        $result = resolve(CheckTitleExistCourseAction::class)->run($request);
        if($result){
            return response()->json(false);
        };
        return response()->json(true);
    }

    public function deleteImg($id, $imageName){
        resolve(DestroyImageCourseAction::class)->run($id, $imageName);
        return redirect()->back();
    }
}
