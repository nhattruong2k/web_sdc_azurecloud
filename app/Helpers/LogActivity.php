<?php


namespace App\Helpers;
use Request;
use App\Models\ActivityLog as LogActivityModel;
class LogActivity
{


    public static function addToLog($subject, $description = null, array $param = [])
    {
        $log = [];
        $log['log_name'] = $subject;
        $log['description'] = $description;
        $log['url'] = Request::fullUrl();
        $log['method'] = Request::method();
        $log['ip'] = Request::ip();
        $log['agent'] = Request::header('user-agent');
        $log['user_id'] = auth()->check() ? auth()->id() : 1;
        $log['input_data'] = json_encode($param);
        LogActivityModel::create($log);
    }


    public static function logActivityLists()
    {
        return LogActivityModel::latest()->paginate(10);
    }


}
