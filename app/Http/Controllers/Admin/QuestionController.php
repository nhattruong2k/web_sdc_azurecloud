<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Questions\CheckExistQuestionAction;
use App\Actions\Questions\CreateQuestionAction;
use App\Actions\Questions\FindQuestionByIdAction;
use App\Actions\Questions\GetPagingQuestionAction;
use App\Actions\Questions\UpdateQuestionAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;
use App\Libs\Constants;
use App\Models\Question;
use App\Repositories\Contracts\QuestionRepository;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuestionController extends Controller
{
    use DeleteModelTrait;
    protected $_questionRepository;

    public function __construct(QuestionRepository $repository)
    {
        $this->_questionRepository = $repository;
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
        $questions = resolve(GetPagingQuestionAction::class)->run($param);
        $this->data['title'] = __('questions.list');
        $this->data['questions'] = $questions;
        return view('admin.questions.index')->with($this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question= new Question();
        $this->data['title'] = __('questions.create');
        $this->data['question'] = $question;
        return view('admin.questions.create')->with($this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        resolve(CreateQuestionAction::class)->run($request);
        notify()->success(trans('questions.create_successfully'));
        return redirect()->route(Question::LIST);
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
        $question = resolve(FindQuestionByIdAction::class)->run($id);
        $this->data['title'] = __('questions.update');
        $this->data['question'] = $question;
        return view('admin.questions.edit')->with($this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, $id)
    {
        resolve(UpdateQuestionAction::class)->run($id, $request);
        notify()->success((trans('questions.update_successfully')));
        return redirect()->route(Question::LIST);
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
        $this->deleteModelTrait($this->_questionRepository, $ids);
        notify()->success((trans('questions.delete_successfully')));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active(Request $request) {
        $question = resolve(FindQuestionByIdAction::class)->run($request->get('id'), ['id', 'status']);
        $status = $question->status == Constants::$status['active'] ? Constants::$status['deactive'] : Constants::$status['active'];
        $this->_questionRepository->update(['status' => $status], $request->get("id"));
        return response()->json(["code" => Response::HTTP_OK, "message" => __('questions.status_successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function questionExist (Request $request)
    {
        $result = resolve(CheckExistQuestionAction::class)->run($request);
        if($result){
            return response()->json(false);
        };
        return response()->json(true);
    }
}
