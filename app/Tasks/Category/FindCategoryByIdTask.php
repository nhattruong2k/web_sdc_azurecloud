<?php 
namespace App\Tasks\Category;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\CategoryRepository;
use Exception;
use App\Exceptions\NotFoundException;

class FindCategoryByIdTask extends Task{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    
    public function run(int $id, $columns = ['*'])
    {
        try {
            $status = $this->categoryRepository->find($id, $columns);
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $status;
    }
}
?>