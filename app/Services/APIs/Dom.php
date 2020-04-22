<?php

namespace App\Services\APIs;

use Carbon\Carbon;

use KubAT\PhpSimple\HtmlDomParser;
use App\Services\Utils\Captcha;

class Dom
{
    public static function query($university_name, $student_code)
    {
        try {
            $hosts = config("messenger.hosts");
            if (array_key_exists($university_name, $hosts) === false) {
                die();
            } else {
                $host = $hosts[$university_name];
            }

            $end_point = $host . "Default.aspx?page=thoikhoabieu&id=" . $student_code;

            $dom = HtmlDomParser::file_get_html($end_point);
            $captcha = (null !== $dom->find("#ctl00_ContentPlaceHolder1_ctl00_lblCapcha font", 0)) ? $dom->find("#ctl00_ContentPlaceHolder1_ctl00_lblCapcha font", 0)->plaintext : null;
            if (isset($captcha) && $captcha !== null) {
                $dom = Captcha::toText($dom, $captcha, $end_point);
            }
            return $dom;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
