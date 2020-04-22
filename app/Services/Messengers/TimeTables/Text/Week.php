<?php

namespace App\Services\Messengers\TimeTables\Text;

use App\Services\Responses\Server;

class Week
{
    public static function send($student_code, $university_name)
    {
        $client = new \GuzzleHttp\Client();
        $res = $client->request("GET", route('get_week_text'), [
            'query' => [
                'student_code' => $student_code,
                'university_name' => $university_name
            ]
        ]);
        $payload = $res->getBody()->getContents();
        if ($payload === "") {
            $payload = "Tuần này không có lịch học nha!";
        }
        return Server::text($payload);
    }
}
