<?php

namespace App\Services\Utils;

use KubAT\PhpSimple\HtmlDomParser;
use Storage;

class ConvertToMessages
{
    public static function result($dom)
    {
        $content = $dom->find("td[onmouseover]");
        if (empty($content)) {
            exit();
        }
        $subjects = [];

        foreach ($content as $key => $value) {
            $data = preg_match_all("/(\').+(\'\')/", $value, $matches);
            $data = preg_replace("/\'/", "", $matches[0]);
            $data = explode(",", $data[0]);
            $subject = [
                "name" => $data[1],
                "code" => $data[2],
                "room" => $data[5],
                "day" => $data[3],
                "lession_started" => $data[6],
                "number_of_lessions" => $data[7],
                "lecturers" => $data[8]
            ];
            array_push($subjects, $subject);
        }
        return $subjects;
    }
}
