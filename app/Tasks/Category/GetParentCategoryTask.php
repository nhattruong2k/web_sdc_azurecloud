<?php
namespace App\Tasks\Category;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\CategoryRepository;
use App\Exceptions\InternalErrorException;
use Exception;
class GetParentCategoryTask extends Task{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function run($getCategories, $id = "", $parentId = 0, $level = 0, $html = "")
    {
        foreach($getCategories as $key => $category){
            if ($category['parent_id'] == $parentId) {
                $html .= "<option value='" . $category['id'] . "' " . ($category['id'] == $id ? ' selected' : '') . ">" . str_repeat('__', $level) . " " . $category['title'] . " </option>";
                $newParentId = $category['id'];
                $html = $this->run($getCategories, $id, $newParentId, $level+1, $html);
            }
        }
        return $html;
    }

    public function buildTree($categories, $parentId = 0){
        $treeCategory = array();
        foreach ($categories as $category) {
            if ($category['parent_id'] == $parentId) {
                $children = $this->buildTree($categories, $category['id']);
                if ($children) {
                    $category['children'] = $children;
                }
                $treeCategory[] = $category;
            }
        }
        return $treeCategory;
    }
}
?>
