<?php

namespace App\Http\Controllers\Api;

use App\Actions\News\FindNewsBySlugAction;
use App\Actions\News\GetListNewsNewAction;
use App\Actions\News\GetPagingNewsAction;
use App\Http\Controllers\Controller;
use App\Libs\Constants;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NewsController extends Controller
{
    /**
     * @OA\Get(
     *      path="/news",
     *      operationId="index",
     *      tags={"News"},
     *
     *      summary="List",
     *      description="List",
     *       @OA\Parameter(
     *          name="search",
     *          in="query",
     *          description="Search",
     *          @OA\Schema(
     *              type="string"
     *          )
     *       ),
     *       @OA\Parameter(
     *          name="category_id",
     *          in="query",
     *          description="Category_id",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *       ),
     *       @OA\Parameter(
     *          name="slug_category",
     *          in="query",
     *          description="slug category",
     *          @OA\Schema(
     *              type="string"
     *          )
     *       ),
     *       @OA\Parameter(
     *          name="page",
     *          in="query",
     *          description="Page",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *       ),
     *       @OA\Parameter(
     *          name="per_page",
     *          in="query",
     *          description="Per Page",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *       ),
     *       @OA\Parameter(
     *          name="feature",
     *          in="query",
     *          description="Feature",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *       ),
     *       @OA\Parameter(
     *          name="sortfield",
     *          in="query",
     *          description="Sort Field",
     *          @OA\Schema(
     *              type="string"
     *          )
     *       ),
     *       @OA\Parameter(
     *          name="sorttype",
     *          in="query",
     *          description="Sort Type",
     *          @OA\Schema(
     *              type="string"
     *          )
     *       ),
     *       @OA\Parameter(
     *          name="keyword",
     *          in="query",
     *          description="keyword",
     *          @OA\Schema(
     *              type="string"
     *          )
     *       ),

     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *         response=404,
     *         description="not found"
     *      ),
     *  )
     */
    public function index(Request $request){
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
        if($request->has('category_id')){
            $param['category_id'] = $request->get('category_id');
        }

        if($request->has('slug_category')){
            $param['slug_category'] = $request->get('slug_category');
        }

        if($request->has('feature')){
            $param['feature'] = $request->get('feature');
        }

        if($request->has('keyword')){
            $param['keyword'] = $request->get('keyword');
        }

        if ($request->has('per_page') && $request->get('per_page') > 0) {
            $param['limit'] = $request->get('per_page');
        }
        $param['status'] = Constants::$status['active'];
        $param['isClient'] = true;
        $news = resolve(GetPagingNewsAction::class)->run($param);
        return $this->sendResult(Response::HTTP_OK, trans('news.list'), $news['data'], $news['keywords']);
    }

    /**
     * @OA\Get(
     *      path="/news/detail/{slug}",
     *      operationId="detail",
     *      tags={"News"},
     *
     *      summary="Detail",
     *      description="detail",
     *      @OA\Parameter(
     *          in="path",
     *          name="slug",
     *          required=true,
     *          description="Slug",
     *          @OA\Schema(
     *            type="string"
     *          )
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *         response=404,
     *         description="not found"
     *      ),
     *  )
     */
    public function detail($slug){
        $news = resolve(FindNewsBySlugAction::class)->run($slug);
        $news->increment('views', 1);
        $news->categories;
        $news->users;
        return $this->sendResult(Response::HTTP_OK, trans('news.detail'), $news);
    }
}
