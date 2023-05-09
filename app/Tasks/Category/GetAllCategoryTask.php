<?php


namespace App\Tasks\Category;


use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\CategoryRepository;

class GetAllCategoryTask extends Task
{
    protected CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function run($column = ['*'])
    {
        return $this->categoryRepository->isShowMenu()->active()->orderBy('order_by', 'ASC')->get($column);
    }
}
