<?php

namespace App\Actions\Lookups;

use App\Cores\Abstracts\Action;
use App\Libs\Constants;
use App\Tasks\Lookups\GetPointLookupTask;
use Illuminate\Http\Request;

class GetPointLookupAction extends Action
{
    public function run(Request $request){
        $params = $request->all();
        $key = '';
        if ($params['key'] > 4){
            return null;
        }
        switch ($params['key']){
            case Constants::$typeLookupPoint['cmnd']:
                $key = 'regis_exams.identitycard';
                break;
            case Constants::$typeLookupPoint['hoten']:
                $key = 'regis_exams.fullname';
                break;
            case Constants::$typeLookupPoint['ngaysinh']:
                $key = 'regis_exams.birthday';
                $params['value'] = strtotime($params['value']);
                break;
        }
        $points = resolve(GetPointLookupTask::class)->run($params, $key);
        if (!empty($points)){
            foreach ($points as $point){
                $point->birthday = timestampToDate($point->birthday);
                if ($params['type'] == Constants::$certificate['coban']){
                    $point->lythuyet = $point->mark_1;
                    $point->thuchanh = $point->mark_2;
                }else{
                    $point->word = [
                        'lythuyet' => $point->mark_1,
                        'thuchanh' => $point->mark_2,
                    ];
                    $point->excel = [
                        'lythuyet' => $point->mark_3,
                        'thuchanh' => $point->mark_4,
                    ];
                    $point->power_point = [
                        'lythuyet' => $point->mark_5,
                        'thuchanh' => $point->mark_6,
                    ];
                }
                unsetData($point, ['mark_1','mark_2','mark_3','mark_4','mark_5','mark_6']);
            }
        }
        return $points;
    }
}
