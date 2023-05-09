<?php
namespace App\Tasks\Category;
use App\Repositories\Contracts\CategoryRepository;

class CheckExistCategoryTask
{
    protected $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function run($title, $id = null)
    {
        return $this->categoryRepository->scopeQuery(function ($query) use($title, $id) {
            $query = $query->whereTitle($title);
            if (!empty($id)) {
                $query = $query->where('id', '!=', $id);
            }
            return $query;
        })->exists();
    }
}
