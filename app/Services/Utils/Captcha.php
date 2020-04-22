<?php

namespace App\Services\Utils;

use KubAT\PhpSimple\HtmlDomParser;

class Captcha
{
    public static function toText($dom, $captcha, $end_point)
    {
        $view_state = $dom->find("input[name=__VIEWSTATE]", 0)->value;
        $view_state_generator = $dom->find("input[name=__VIEWSTATEGENERATOR]", 0)->value;
        $client = new \GuzzleHttp\Client(['cookies' => true]);
        $by_pass_captcha = $client->request("POST", $end_point, [
            'form_params' => [
                'ctl00$ContentPlaceHolder1$ctl00$txtCaptcha' => $captcha,
                'ctl00$ContentPlaceHolder1$ctl00$btnXacNhan' => "Vào website",
                "__EVENTTARGET" => "",
                "__EVENTARGUMENT" => "",
                "__VIEWSTATE" => $view_state,
                "__VIEWSTATEGENERATOR" => $view_state_generator
            ]
        ]);

        $get_request = $client->request("GET", $end_point)->getBody();
        $dom = HtmlDomParser::str_get_html($get_request);
        return $dom;
    }
}
