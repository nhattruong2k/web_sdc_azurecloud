<?php

namespace App\Http\Controllers\Api;

use App\Actions\Menus\GetAllMenuAction;
use App\Actions\Menus\GetMenuCategoryAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function PHPUnit\Framework\returnArgument;

class MenuController extends Controller
{
    /**
     * @OA\Get(
     ** path="/menus",
     *   tags={"Menus"},
     *     security={
     *   },
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function index(Request $request){
        $menus = resolve(GetAllMenuAction::class)->run();
        return $this->sendResult(Response::HTTP_OK, trans('menus.list'), $menus);
    }

    /**
    * @OA\Get(
    ** path="/menu-categories",
    *   tags={"Menus"},
    *     security={
    *   },
    *
    *   @OA\Response(
    *      response=200,
    *       description="Success",
    *      @OA\MediaType(
    *           mediaType="application/json",
    *      )
    *   ),
    *   @OA\Response(
    *      response=401,
    *       description="Unauthenticated"
    *   ),
    *   @OA\Response(
    *      response=400,
    *      description="Bad Request"
    *   ),
    *   @OA\Response(
    *      response=404,
    *      description="not found"
    *   ),
    *      @OA\Response(
    *          response=403,
    *          description="Forbidden"
    *      )
    *)
    **/
    public function menuCategory(){
        $menu_categories = resolve(GetMenuCategoryAction::class)->run();
        return $this->sendResult(Response::HTTP_OK, trans('menus.categories'), $menu_categories);
    }
}
