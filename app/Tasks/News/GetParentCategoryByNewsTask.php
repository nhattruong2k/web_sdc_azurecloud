<?php 
namespace App\Tasks\News;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\CategoryRepository;
use App\Exceptions\InternalErrorException;
use Exception;
class GetParentCategoryByNewsTask extends Task{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function run($getCategories,$category_id, $parentId = 0, $level = 0, $html = "")
    {
        foreach($getCategories as $key => $category){
            if ($category['parent_id'] == $parentId) {
                $html .= "<option value='" . $category['id'] . "' " . ($category['id'] == $category_id ? ' selected' : '') . ">" . str_repeat('__', $level) . " " . $category['title'] . " </option>";
                $newParentId = $category['id'];
                $html = $this->run($getCategories, $category_id, $newParentId, $level+1, $html);
            }
        }
        return $html;
    }
}
?>