<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Messenger Configuration
    |--------------------------------------------------------------------------
    |
    */

    'token' => env('MESSENGER_TOKEN'),
    'message' => env('MESSENGER_MESSAGE'),
    'profile' => env('MESSENGER_PROFILE',),
    'custom_user_settings' => env('MESSENGER_CUSTOM_USER_SETTINGS'),
    'hosts' => [
        "PTIT" => "http://qldt.ptit.edu.vn/",
        "FTU" => "http://ftugate.ftu.edu.vn/",
        "NUCE" => "http://daotao.nuce.edu.vn/",
        "HANU" => "http://qldt.hanu.vn/",
        "BA" => "http://congthongtin.hvnh.edu.vn/",
        "VNUA" => "http://daotao.vnua.edu.vn/",
        "HUMG" => "https://daotao.humg.edu.vn/",
        "HUFLIT" => "https://huflit.edu.vn/",
        "TNUT" => "http://dkmhqt.tnut.edu.vn/",
        "TDMU" => "https://dkmh.tdmu.edu.vn",
        "HCMIU" => "https://edusoftweb.hcmiu.edu.vn/"
    ]
];
