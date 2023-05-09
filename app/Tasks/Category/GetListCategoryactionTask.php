<?php
namespace App\Tasks\Category;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\CategoryRepository;

class GetListCategoryactionTask extends Task {

    protected $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function run($id = null, $cate_news=false, array $columns = ['*'])
    {
        $category = $this->categoryRepository->scopeQuery(function ($query) use($id, $cate_news, $columns) {
            if($cate_news == true){
                $query = $query->Active()->with('parentCategory','children')->select($columns);
            }elseif($cate_news == false){
                $query = $query->Active()->ParentCategory($id)->with('parentCategory','children')->select($columns);
            }
            return $query;
        });
        return $category->get();
    }
}

?>
