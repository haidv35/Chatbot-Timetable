<?php

namespace App\Services\Utils;

use KubAT\PhpSimple\HtmlDomParser;

class ExistsStudentCode
{
    public static function result($dom)
    {
        $content = $dom->find("td[onmouseover]");
        if (empty($content)) {
            return false;
        }
        return true;
    }
}
