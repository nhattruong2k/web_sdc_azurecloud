<?php


namespace App\Tasks\CourseCategories;


use App\Cores\Abstracts\Task;

class GetTreeCourseCategoryTask extends Task
{
    public function run($courseCategories, $id = "", $parentId = 0, $level = 0, $html = ""){
        foreach($courseCategories as $key => $value){
            if ($value['parent_id'] == $parentId) {
                $html .= "<option value='" . $value['id'] . "' " . ($value['id'] == $id ? ' selected' : '') . ">" . str_repeat('__', $level) . " " . $value['title'] . " </option>";
                $newParentId = $value['id'];
                $html = $this->run($courseCategories, $id, $newParentId, $level+1, $html);
            }
        }
        return $html;
    }
}
