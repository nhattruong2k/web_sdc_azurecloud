<?php
namespace App\Traits;
use Illuminate\Support\Facades\Log;
use Exception;

trait DeleteModelTrait{
   public function deleteModelTrait($model, string $ids)
   {
        try{
            $arr_ids = explode(",", $ids);
            return $model->whereIn('id', $arr_ids)->delete();
        }catch(Exception $exception){
            Log::error('message: '. $exception->getMessage() . '     Line: ' . $exception->getLine());
        }
   }
}
