<?php

namespace App\Http\Controllers\Admin;

use App\Actions\CourseCategories\CheckExistCourseCategoryAction;
use App\Actions\CourseCategories\CreateCourseCategoryAction;
use App\Actions\CourseCategories\DestroyImageCourseCategoryAction;
use App\Actions\CourseCategories\FindCourseCategoryByFieldAction;
use App\Actions\CourseCategories\FindCourseCategoryByIdAction;
use App\Actions\CourseCategories\GetPagingCourseCategoryAction;
use App\Actions\CourseCategories\UpdateCourseCategoryAction;
use App\Actions\Courses\FindCourseByFieldAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseCategoryRequest;
use App\Libs\Constants;
use App\Models\CourseCategories;
use App\Repositories\Contracts\CourseCategoriesRepository;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CourseCategoryController extends Controller
{
    use DeleteModelTrait;
    protected $courseCategoriesRepository;

    public function __construct(CourseCategoriesRepository $courseCategoriesRepository){
        $this->courseCategoriesRepository = $courseCategoriesRepository;
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

        $courseCategories = resolve(GetPagingCourseCategoryAction::class)->run($param);
        $this->data['title'] = __('category.list');
        $this->data['courseCategories'] = $courseCategories;
        return view('admin.course_categories.index')->with($this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courseCategory = new CourseCategories();
        $this->data['title'] = __('course_categories.create');
        $this->data['courseCategory'] = $courseCategory;
        return view('admin.course_categories.create')->with($this->data);
    }

    public function store(CourseCategoryRequest $request)
    {
        resolve(CreateCourseCategoryAction::class)->run($request);
        notify()->success(trans('course_categories.create_successfully'));
        return redirect(route(CourseCategories::LIST));
    }

    public function edit($id)
    {
        $courseCategory =  resolve(FindCourseCategoryByIdAction::class)->run($id);
        $this->data['title'] = __('course_categories.update');
        $this->data['courseCategory'] = $courseCategory;
        return view('admin.course_categories.edit')->with($this->data);
    }

    public function update(CourseCategoryRequest $request, $id)
    {
        resolve(UpdateCourseCategoryAction::class)->run($id, $request);
        notify()->success(trans('course_categories.update_successfully'));
        return redirect(route(CourseCategories::LIST));
    }

    public function active(Request $request){
        $course_category = resolve(FindCourseCategoryByIdAction::class)->run($request->get('id'), ['id', 'status']);
        $status = $course_category->status == Constants::$status['active'] ? Constants::$status['deactive'] : Constants::$status['active'];
        $this->courseCategoriesRepository->update(['status' => $status], $request->get("id"));
        return response()->json(["code" => Response::HTTP_OK, "message" => __('common.status_successfully')]);
    }

    public function destroy(Request $request)
    {
        $ids = $request->get('id');
        $arr_ids = explode(",", $ids);
        $courseCategory = resolve(FindCourseCategoryByFieldAction::class)->run('parent_id', $arr_ids);
        $course = resolve(FindCourseByFieldAction::class)->run('course_category_id', $arr_ids);
        if ($courseCategory || $course){
            notify()->error(trans('course_categories.delete_fail'));
        }else{
            $this->deleteModelTrait($this->courseCategoriesRepository, $ids);
            notify()->success(trans('course_categories.delete_successfully'));
        }
        return redirect()->back();
    }

    public function titleExist(Request $request){
        $result = resolve(CheckExistCourseCategoryAction::class)->run($request);
        if($result){
            return response()->json(false);
        };
        return response()->json(true);
    }

    public function deleteImg($id, $imageName){
        resolve(DestroyImageCourseCategoryAction::class)->run($id, $imageName);
        return redirect()->back();
    }
}
