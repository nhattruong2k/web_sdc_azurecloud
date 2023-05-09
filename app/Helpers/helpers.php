<?php

use Illuminate\Http\UploadedFile;
use App\Tasks\Commons\ResizeImageTask;
use Illuminate\Support\Facades\Storage;
use App\Tasks\Commons\GenerateFileNameTask;

if (!function_exists('sort_title')) {
    function sort_title($name = '', $title = '') {
        if (Request::has('filter')) {
            return $title;
        }

        $base_url = Request::all();
        $base_url['sortfield'] = $name;
        $base_url['sorttype'] = "ASC";
        if (Request::has('page')) {
            $base_url['page'] = Request::get('page');
        }

        //sorting
        if (Request::has('sortfield') && Request::has('sorttype')) {
            $base_url['sortfield'] = $name;
            $base_url['sorttype'] = (Request::get('sorttype') == "ASC") ? "DESC" : "ASC";
        }

        $type_sort = Request::get('sorttype') == "ASC" ? '<i class="fa fa-sort-amount-asc"></i>' : '<i class="fa fa-sort-amount-desc"></i>';
        $link = "<a href=" . base_url($base_url) . ">" . (($name == Request::get('sortfield')) ? $type_sort : '') . " " . (($title != '') ? $title : $name) . "</a>";

        return $link;
    }
}

if (!function_exists('base_url')) {
    function base_url($base_url = array()) {
        $url = Request::url() . '?';
        foreach ($base_url as $key => $value) {
            $url .= $key . "=" . $value . "&";
        }
        //remove last '&'
        return rtrim($url, "&");
    }
}

if (!function_exists('generatorString')) {

    function generatorString($str) {
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D' => 'Đ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
        foreach ($unicode as $nonUnicode => $uni) {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        return strtolower(str_replace(" ", '-', trim($str)));
    }
}

if (!function_exists('checkPermission')) {
    function checkPermission($permissionCheck)
    {
        if (auth()->user()->role == \App\Libs\Constants::$administrator){
            return true;
        }
        $roles = auth()->user()->roles;
        foreach($roles as $role){
            $permissions = $role->permissions;
            $userPermission =  auth()->user()->permissions;
            if($permissions->contains('key_code', $permissionCheck)){
                return true;
            }
            if($userPermission->contains('key_code', $permissionCheck)){
                return true;
            }
        }
        return false;
    }
}

if (!function_exists('getFilenameFromUrl')) {
    function getFilenameFromUrl($url)
    {
        return basename(parse_url($url, PHP_URL_PATH));
    }
}

if (!function_exists('timestampToDate')) {
    function timestampToDate($timestamp = '') {
        if ($timestamp) {
            return date('d-m-Y', $timestamp);
        } else {
            return '';
        }
    }
}


if (!function_exists('formatDate')) {
    function formatDate($date = '' , $format = 'Y-m-d H:i:s') {
        if ($date) {
            return date( $format, strtotime($date));
        } else {
            return '';
        }
    }
}


if (!function_exists('unsetData')) {
    function unsetData($data, array $keys)
    {
        foreach ($keys as $key){
            unset($data->$key);
        }
        return $data;
    }
}
