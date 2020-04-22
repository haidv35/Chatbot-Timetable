<?php

namespace App\Services\APIs;

use App\Services\Utils\ConvertToMessages;
use Carbon\Carbon;
use App\Services\Contracts\API;

class TextScheduleWeek implements API
{
    public static function query($dom)
    {
        $lists = ConvertToMessages::result($dom);
        $ans = "";
        foreach ($lists as $list) {
            $ans .= $list["name"] . "\n" . $list["code"] . " " . $list["room"] . "\n" . $list["day"] . ", Tiết bắt đầu: " . $list["lession_started"] . " Số tiết: " . $list["number_of_lessions"] . " Giảng viên: " . $list["lecturers"];
            $ans .= "\n----------------------\n";
        }
        return $ans;
        // var_dump($ans);
    }
}
