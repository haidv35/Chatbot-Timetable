<?php

namespace App\Services\Utils;

use KubAT\PhpSimple\HtmlDomParser;
use Storage;

class ConvertToImage
{
    public static function result($dom)
    {
        $contents = $dom->find("body", 0);
        preg_match_all('/(<table id="ctl00_ContentPlaceHolder1_ctl00_Table1").+(ctl00_ContentPlaceHolder1_ctl00_pnlDienGiaiMauTKBHKCu">)/', $contents, $matches);
        // var_dump($matches);
        // Storage::put("test.html", $matches[0]);
        // die();
        $html = $matches[0][0];
        $css = 'body{font-family:tahoma,verdana;margin: 0;font-size: 11px}#ctl00_ContentPlaceHolder1_ctl00_Table1{border-color: #999;border-width: 1px;border-style: Solid;height: 100%;width: 100%;border-collapse: collapse}.classTable{font-family: Arial;font-weight: 700}.Label{font-family: Tahoma}#ctl00_ContentPlaceHolder1_ctl00_Table1>tbody>tr{height: 22px;display: table-row;vertical-align: inherit;border-color: inherit}#ctl00_ContentPlaceHolder1_ctl00_Table1>thead>tr>td{border-right: 1px solid gray}#ctl00_ContentPlaceHolder1_ctl00_Table1>tbody>tr{border: 1px solid gray}#ctl00_ContentPlaceHolder1_ctl00_Table1>tbody>tr>td{border: 1px solid gray;height: 11px;width: 100px}.textTable{width: auto!important;font-size:8pt;font-family:Arial}.textTable tbody td{width: auto!important}';

        $client = new \GuzzleHttp\Client();
        $res = $client->request('POST', 'https://htmlcsstoimage.com/demo_run', [
            'json' => ['html' => $html, 'css' => $css]
        ]);

        $url = json_decode($res->getBody())->url;
        return $url;
    }
}
