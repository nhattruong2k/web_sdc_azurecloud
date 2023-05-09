<?php
namespace App\Tasks\Category;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\CategoryRepository;

class FindCategoryByFieldTask extends Task
{
    protected CategoryRepository $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function run($field, $value){
        return $this->categoryRepository->scopeQuery(function ($query) use($field, $value) {
            $query = $query->where($field, $value);
            return $query;
        })->exists();
    }
}
