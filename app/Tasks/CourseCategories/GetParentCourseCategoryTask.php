<?php
namespace App\Tasks\CourseCategories;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\CourseCategoriesRepository;
class GetParentCourseCategoryTask extends Task{
    protected $courseCategoriesRepository;

    public function __construct(CourseCategoriesRepository $courseCategoriesRepository)
    {
        $this->courseCategoriesRepository = $courseCategoriesRepository;
    }

    public function run($courseCategories, $id = "", $parentId = 0, $level = 0, $html = "")
    {
        foreach($courseCategories as $key => $value){
            if ($value['parent_id'] == $parentId) {
                $html .= "<option value='" . $value['id'] . "' " . ($value['id'] == $id ? ' selected' : '') . ">" . str_repeat('__', $level) . " " . $value['title'] . " </option>";
                $newParentId = $value['id'];
                $html = $this->run($courseCategories, $id, $newParentId, $level+1, $html);
            }
        }
        return $html;
    }

    public function buildTree($courseCategories, $parentId = 0) {
        $treeCourseCategory = array();
        foreach ($courseCategories as $value) {
            if ($value['parent_id'] == $parentId) {
                $children = $this->buildTree($courseCategories, $value['id']);
                if ($children) {
                    $value['children'] = $children;
                }
                $treeCourseCategory[] = $value;
            }
        }
        return $treeCourseCategory;
    }
}
?>
