<?php 

namespace App\Tasks\Category;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\CategoryRepository;
use Exception;
use App\Exceptions\NotFoundException;

class FindCategoryBySlugTask extends Task{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function run(string $slug, $columns = ['*'])
    {
        try {
            $category = $this->categoryRepository->findByField('slug', $slug, $columns)->first();
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $category;
    }
}
?>