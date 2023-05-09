<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Helpers\Cache;
use App\Libs\Constants;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Actions\News\CreateNewsAction;
use App\Actions\News\UpdateNewsAction;
use App\Http\Requests\New\NewsRequest;
use App\Actions\News\FindNewsByIdAction;
use App\Actions\News\GetCategoryByNewsId;
use App\Actions\News\GetPagingNewsAction;
use App\Actions\News\DestroyImageNewAction;
use App\Repositories\Contracts\NewsRepository;
use App\Actions\News\CheckExistTitleNewsAction;
use App\Actions\News\FindIdByContentNewsAction;
use App\Actions\Category\GetParentCategoryAction;
use App\Helpers\LogActivity;

class NewsController extends Controller
{
    protected $_newsRepository;
    protected $news;

    public function __construct(NewsRepository $newsRepository, News $news) {
        $this->news = $news;
        $this->_newsRepository = $newsRepository;
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
            if ($request->has('category_id')) {
                $param['category_id'] = $request->get('category_id');
            }
            $param['isClient'] = false;
            $news = resolve(GetPagingNewsAction::class)->run($param);
            $this->data['title'] = __('news.list');
            if(isset($param['category_id'])){
                $this->data['parent'] = resolve(GetParentCategoryAction::class)->run($param['category_id'], true);
            }else{
                $this->data['parent'] = resolve(GetParentCategoryAction::class)->run();
            }
            $this->data['news'] = $news['data'];
            return view('admin.news.index')->with($this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $news = new News();
        $news['parent'] = resolve(GetParentCategoryAction::class)->run();
        $this->data['title'] = __('news.create');
        $this->data['news'] = $news;
        return view('admin.news.create')->with($this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        resolve(CreateNewsAction::class)->run($request);
        notify()->success(trans('news.create_successfully'));
        LogActivity::addToLog(auth()->user()->name. ' ' . trans("common.add"), trans("news.create"), $request->all());
        return redirect(route(News::LIST));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news, $id)
    {
        $news =  resolve(FindNewsByIdAction::class)->run($id);
        $news['parent'] = resolve(GetCategoryByNewsId::class)->run($news->category_id);
        $this->data['title'] = __('news.update');
        $this->data['news'] = $news;
        return view('admin.news.edit')->with($this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, $id)
    {
        resolve(UpdateNewsAction::class)->run($id, $request);
        notify()->success(trans('news.update_successfully'));
        LogActivity::addToLog(auth()->user()->name. ' ' . trans("common.update"), trans("news.update"), $request->all());
        return redirect(route(News::LIST));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news, Request $request)
    {
        $ids = $request->get('id');
        $arr_ids = explode(",", $ids);
        $this->news->whereIn('id', $arr_ids)->delete();
        Cache::delete(Constants::$fileName['new']);
        notify()->success(trans('news.delete_successfully'));
        LogActivity::addToLog(auth()->user()->name. ' ' . trans("common.delete"), trans("news.delete"));
        return redirect()->back();
    }

    public function titleExist(Request $request){
        $result = resolve(CheckExistTitleNewsAction::class)->run($request);
        if($result){
            return response()->json(false);
        };
        return response()->json(true);
    }

    public function active(Request $request){
        $news = resolve(FindNewsByIdAction::class)->run($request->get('id'), ['id', 'status']);
        $status = $news->status == Constants::$status['active'] ? Constants::$status['deactive'] : Constants::$status['active'];
        $this->_newsRepository->update(['status' => $status], $request->get("id"));
        return response()->json(["code" => Response::HTTP_OK, "message" => __('news.status_successfully')]);
    }

    public function detailContent(Request $request){
        return resolve(FindIdByContentNewsAction::class)->run($request);
    }

    public function deleteImg($id, $imageName){
        resolve(DestroyImageNewAction::class)->run($id, $imageName);
        return redirect()->back();
    }
}
