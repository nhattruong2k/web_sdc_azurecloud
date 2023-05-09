<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Category\DestroyImageCategoryAction;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\Category\GetPagingCategoryAction;
use App\Actions\Category\FindCategoryByIdAction;
use App\Actions\Category\GetParentCategoryAction;
use App\Actions\Category\CreateCategoryAction;
use App\Actions\Category\UpdateCategoryAction;
use App\Actions\Category\CheckExistCategoryAction;
use App\Actions\Category\FindCategoryByFieldAction;
use  App\Actions\News\FindNewsByFieldAction;
use App\Libs\Constants;
use App\Repositories\Contracts\CategoryRepository;
use Illuminate\Http\Response;
use App\Traits\DeleteModelTrait;
use App\Http\Requests\Category\CategoryRequest;

class CategoryController extends Controller
{
    use DeleteModelTrait;
    protected $_idStatusCategory;
    protected $category;

    public function __construct(CategoryRepository $_idStatusCategory, Category $category){
        $this->category = $category;
        $this->_idStatusCategory = $_idStatusCategory;
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

        $categories = resolve(GetPagingCategoryAction::class)->run($param);
        $this->data['title'] = __('category.list');
        $this->data['categories'] = $categories;
        return view('admin.category.index')->with($this->data);
    }

    public function active(Request $request){
        $status_cate = resolve(FindCategoryByIdAction::class)->run($request->get('id'), ['id', 'status']);
        $status = $status_cate->status == Constants::$status['active'] ? Constants::$status['deactive'] : Constants::$status['active'];
        $this->_idStatusCategory->update(['status' => $status], $request->get("id"));
        return response()->json(["code" => Response::HTTP_OK, "message" => __('category.status_successfully')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();
        $category['parent'] = resolve(GetParentCategoryAction::class)->run();
        $this->data['title'] = __('category.create');
        $this->data['category'] = $category;
        return view('admin.category.create')->with($this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function status(Request $request){
        resolve(CreateCategoryAction::class)->run($request);
        return response()->json(["code" => Response::HTTP_OK, "message" => __('category.status_successfully')]);
    }

    public function store(CategoryRequest $request)
    {
        resolve(CreateCategoryAction::class)->run($request);
        notify()->success(trans('category.create_successfully'));
        return redirect(route(Category::LIST));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, $id)
    {
        $category =  resolve(FindCategoryByIdAction::class)->run($id);
        $category['parent'] = resolve(GetParentCategoryAction::class)->run($id);
        $this->data['title'] = __('category.update');
        $this->data['category'] = $category;
        return view('admin.category.edit')->with($this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category, $id)
    {
        resolve(UpdateCategoryAction::class)->run($id, $request);
        notify()->success(trans('category.update_successfully'));
        return redirect(route(CATEGORY::LIST));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, Request $request)
    {
        $ids = $request->get('id');
        $arr_ids = explode(",", $ids);
        $category = resolve(FindCategoryByFieldAction::class)->run('parent_id', $arr_ids);
        $new_category = resolve(FindNewsByFieldAction::class)->run('category_id', $arr_ids);
        if ($category){
            notify()->warning(trans('category.error_children'));
        }elseif($new_category){
            notify()->warning(trans('category.warning_new'));
        }else{
            $this->deleteModelTrait($this->_idStatusCategory, $ids);
            notify()->success(trans('category.delete_successfully'));
        }
        return redirect()->back();
    }

    public function titleExist(Request $request){
        $result = resolve(CheckExistCategoryAction::class)->run($request);
        if($result){
            return response()->json(false);
        };
        return response()->json(true);
    }

    public function deleteImg($id, $imageName){
        resolve(DestroyImageCategoryAction::class)->run($id, $imageName);
        return redirect()->back();
    }
}
