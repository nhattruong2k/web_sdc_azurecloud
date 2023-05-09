<?php

namespace App\Tasks\Category;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\CategoryRepository;

class GetPagingCategoryTask extends Task
{

    protected $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function run(array $param, array $columns = ['*'])
    {

        $columns = [
            'categories.id',
            'categories.title',
            'categories.slug',
            'categories.summary',
            'categories.parent_id',
            'categories.image',
            'categories.status',
            'categories.is_show_menu',
        ];
        $categories = $this->categoryRepository->with('parentCategory')->scopeQuery(function ($query) use ($param) {
            if ((isset($param['search']) && $param['search'])) {
                $query->where('categories.title', 'like', "%" . $param['search'] . "%");
            }

            if (!empty($param['status'])) {
                $query->where('category.status', $param['status']);
            }
            return $query;
        });
        $categories->orderBy($param['sortfield'], $param['sorttype']);
        return $categories->paginate($param['limit'], $columns);
    }
}
