<?php

namespace App\Actions\Lookups;

use App\Cores\Abstracts\Action;
use App\Libs\Constants;
use App\Tasks\Lookups\GetDiplomaLookupTask;
use Illuminate\Http\Request;

class   GetDiplomaLookupAction extends Action
{
    public function run(Request $request){
        $params = $request->all();
        $params['ngaysinh'] = strtotime($params['ngaysinh']);
        $key = null;
        $value = $params['value'] ?? null;
        if ((!empty($value) && empty($params['key'])) || !empty($params['key']) && $params['key'] > 5){
            return null;
        }
        if (!empty($params['key'])){
            switch ($params['key']){
                case Constants::$typeLookupDiplomas['sohieucc']:
                    $key = 'list_exams.certificate_no';
                    break;
                case Constants::$typeLookupDiplomas['cmnd']:
                    $key = 'regis_exams.identitycard';
                    break;
                case Constants::$typeLookupDiplomas['sovaoso']:
                    $key = 'list_exams.date_entered';
                    break;
                case Constants::$typeLookupDiplomas['khoathi']:
                    $key = 'list_exams.day_exam';
                    break;
                case Constants::$typeLookupDiplomas['quyetdinh']:
                    $key = 'list_exams.decide_number';
                    break;
            }
        }
        $diplomas = resolve(GetDiplomaLookupTask::class)->run($params, $key, $value);
        if (!empty($diplomas)){
            foreach ($diplomas as $diploma){
                $diploma->birthday = timestampToDate($diploma->birthday);
                if ($params['type'] == Constants::$certificate['coban']){
                    $diploma->lythuyet = $diploma->mark_1;
                    $diploma->thuchanh = $diploma->mark_2;
                }else{
                    $diploma->mon1 = [
                        'lythuyet' => $diploma->mark_1,
                        'thuchanh' => $diploma->mark_2,
                    ];
                    $diploma->mon2 = [
                        'lythuyet' => $diploma->mark_3,
                        'thuchanh' => $diploma->mark_4,
                    ];
                    $diploma->mon3 = [
                        'lythuyet' => $diploma->mark_5,
                        'thuchanh' => $diploma->mark_6,
                    ];
                }
                unsetData($diploma, ['mark_1','mark_2','mark_3','mark_4','mark_5','mark_6']);
            }
        }
        return $diplomas;
    }
}
