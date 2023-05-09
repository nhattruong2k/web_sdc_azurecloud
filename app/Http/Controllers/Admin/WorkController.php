<?php

namespace App\Http\Controllers\Admin;

use App\Models\Work;
use App\Libs\Constants;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\DeleteModelTrait;
use App\Http\Requests\WorkRequest;
use App\Http\Controllers\Controller;
use App\Actions\Works\CreateWorkAction;
use App\Actions\Works\UpdateWorkAction;
use App\Actions\Works\FindWorkByIdAction;
use App\Actions\Works\GetPagingWorkAction;
use App\Actions\Works\DestroyImageWorkAction;
use App\Repositories\Contracts\WorksRepository;
use App\Actions\CourseCategories\GetAllCourseCategoryAction;
use App\Actions\CourseCategories\GetTreeCourseCategoryAction;

class WorkController extends Controller
{
    use DeleteModelTrait;
    protected $worksRepository;

    public function __construct(WorksRepository $worksRepository)
    {
        $this->worksRepository = $worksRepository;
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

        if ($request->has('category_course_id')) {
            $param['category_course'] = $request->get('category_course_id');
        }
        
        if ($request->has('numpaging') && $request->get('numpaging') > 0) {
            $param['limit'] = $request->get('numpaging');
        }
        $works = resolve(GetPagingWorkAction::class)->run($param);
        $category_course =  resolve(GetAllCourseCategoryAction::class)->run();
        $this->data['title'] = __('works.list');
        $this->data['works'] = $works['data'];
        $this->data['category_course'] = $category_course;
        return view('admin.works.index')->with($this->data)->with(['code' => Response::HTTP_OK, 'message' => __('works.list')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $work = new Work();
        $courseCategories = resolve(GetTreeCourseCategoryAction::class)->run();
        $this->data['title'] = __('works.create');
        $this->data['work'] = $work;
        $this->data['courseCategories'] = $courseCategories;
        return view('admin.works.create')->with($this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkRequest $request)
    {
        resolve(CreateWorkAction::class)->run($request);
        notify()->success(trans('works.create_successfully'));
        return redirect(route(Work::LIST));
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
        $work =  resolve(FindWorkByIdAction::class)->run($id);
        $courseCategories = resolve(GetTreeCourseCategoryAction::class)->run($work->course_category_id);
        $this->data['title'] = __('works.update');
        $this->data['work'] = $work;
        $this->data['courseCategories'] = $courseCategories;
        return view('admin.works.edit')->with($this->data)->with(['code' => Response::HTTP_OK, 'message' => __('works.update')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WorkRequest $request, $id)
    {
        resolve(UpdateWorkAction::class)->run($id, $request);
        notify()->success(trans('works.update_successfully'));
        return redirect(route(Work::LIST));
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
        $this->deleteModelTrait($this->worksRepository, $ids);
        notify()->success(trans('works.delete_successfully'));
        return redirect()->back();
    }

    public function active(Request $request)
    {
        $work = resolve(FindWorkByIdAction::class)->run($request->get('id'), ['id', 'status']);
        $status = $work->status == Constants::$status['active'] ? Constants::$status['deactive'] : Constants::$status['active'];
        $this->worksRepository->update(['status' => $status], $request->get("id"));
        return response()->json(["code" => Response::HTTP_OK, "message" => __('works.status_successfully')]);
    }

    public function deleteImg($id, $imageName)
    {
        resolve(DestroyImageWorkAction::class)->run($id, $imageName);
        return redirect()->back();
    }
}
