<?php


namespace App\Libs;


class Constants
{
    public static $list_numpaging = [
        '10' => 10,
        '15' => 15,
        '20' => 20,
        '30' => 30,
        '50' => 50,
        '100' => 100,
        '200' => 200
    ];

    public static $is_visible = [
        'active' => 1,
        'deactive' => 0,
    ];
    public static $status = [
        'active' => 1,
        'deactive' => 0,
    ];

    public static $person = [
        'teacher' => 0,
        'student' => 1,
        'mentor' => 2,
    ];

    public static $administrator = 'administrator';

    public static $image_default = 'default.jpg';
    public static $envelopeEmail = 'Thông tin tư vấn';
    
    public static $certificate = [
        'coban' => 1,
        'nangcao' => 2
    ];

    public static $typeLookupPoint = [
        'mahocvien' => 1,
        'cmnd' => 2,
        'hoten' => 3,
        'ngaysinh' => 4,
    ];

    public static $typeLookupDiplomas = [
        'sohieucc' => 1,
        'cmnd' => 2,
        'sovaoso' => 3,
        'khoathi' => 4,
        'quyetdinh' => 5,
    ];

    public static $fileName = [
        'configs'=>'Cache/config.tmp',
        'generalSetting'=>'Cache/generalSetting.tmp',
        'new'=>'Cache/new.tmp',
        'course'=>'Cache/course.tmp',
    ];

    public static $disk = 'images';
}
