<?php

namespace App\Services\Messengers\Chats;

use Carbon\Carbon;

class Time
{
    public static function checkTime()
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $hour = $now->hour;
        if ($hour >= 0 && $hour <= 7) {
            return " học sớm thế <3";
        } else if ($hour <= 12) {
            return " chúc một buổi sáng tốt lành nha ^_^";
        } else if ($hour <= 14) {
            return " học trưa chắc mệt lắm nhỉ :p";
        } else if ($hour <= 18) {
            return " chúc một chiều tốt lành, nhớ về sớm kẻo tắc đường nha 😂 ";
        } else {
            return " hôm nay học muộn thế trời :> ";
        }
    }
}
