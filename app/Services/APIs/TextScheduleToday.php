<?php

namespace App\Services\APIs;

use App\Services\Utils\ConvertToMessages;
use Carbon\Carbon;
use App\Services\Contracts\API;

class TextScheduleToday implements API
{
    public static function getDayOfWeek($day)
    {
        $weekMap = [
            "Monday" => "Thứ Hai",
            "Tuesday" => "Thứ Ba",
            "Wednesday" => "Thứ Tư",
            "Thursday" => "Thứ Năm",
            "Friday" => "Thứ Sáu",
            "Saturday" => "Thứ Bảy",
            "Sunday" => "Chủ Nhật",
        ];
        return $weekMap[$day];
    }

    public static function getLessionStarted($lession_started)
    {
        $lessionStartedMap = [
            1 => "7:00 - 7:50",
            2 => "8:00 - 8:50",
            3 => "9:00 - 9:50",
            4 => "10:00 - 10:50",
            5 => "11:00 - 11:50",
            6 => "12:00 - 12:50",
            7 => "14:00 - 14:50",
            8 => "15:00 - 15:50",
            9 => "16:00 - 16:50",
            10 => "17:00 - 17:50",
            11 => "18:00 - 18:50",
            12 => "19:00 - 19:50",
        ];
        return $lessionStartedMap[$lession_started];
    }

    public static function query($dom)
    {
        $lists = ConvertToMessages::result($dom);
        $ans = "";
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $day = $now->englishDayOfWeek;
        foreach ($lists as $list) {
            if (self::getDayOfWeek($day) == $list["day"]) {
                $ans .= "*" . $list["name"] . "*" . "\n";
                $ans .= "(" . $list["code"] . ")" . "\n";
                $ans .= "Phòng: " . $list["room"] . "\n";
                $ans .= $list["day"] . ", " . $now->format("d/m/Y") . "\n";
                $ans .= "Tiết bắt đầu: " . $list["lession_started"] . "\n";
                $ans .= "Thời gian: " . self::getLessionStarted($list["lession_started"]) . "\n";
                $ans .= "Số tiết: " . $list["number_of_lessions"] . "\n";
                $ans .= "Giảng viên: " . $list["lecturers"];
                $ans .= "\n----------------------\n";
            }
        }
        return $ans;
    }
}
