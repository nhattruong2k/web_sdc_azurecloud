<?php 

namespace App\Tasks\Category;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\CategoryRepository;
use App\Exceptions\InternalErrorException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\NotFoundException;

class UpdateCategoryTask extends Task {
    protected $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function run($data, int $categoryId)
    {
        if (empty($data)) {
            throw new InternalErrorException(__('common.inputs_empty'));
        }
        try {
            $category = $this->categoryRepository->update($data, $categoryId);
        } catch (ModelNotFoundException $ex) {
            throw new NotFoundException(__('common.not_found'));
        } catch (Exception $ex) {
            throw new InternalErrorException(__('category.update_error'));
        }
        return $category;
    }
}
?>