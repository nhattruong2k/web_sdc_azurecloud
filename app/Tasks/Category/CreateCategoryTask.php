<?php 
namespace App\Tasks\Category;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\CategoryRepository;
use App\Exceptions\InternalErrorException;
use Exception;

class CreateCategoryTask extends Task {
    protected CategoryRepository $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function run(array $data)
    {   
        try {
            $category = $this->categoryRepository->create($data);
        } catch (Exception $ex) {
            throw new InternalErrorException(__('category.create_error'));
        }
        return $category;
    }
}
?>