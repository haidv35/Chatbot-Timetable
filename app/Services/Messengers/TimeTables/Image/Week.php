<?php

namespace App\Services\Messengers\TimeTables\Image;

use App\Services\Responses\Server;

class Week
{
    public static function send($student_code, $university_name)
    {
        $client = new \GuzzleHttp\Client();

        $res = $client->request("GET", route('get_image'), [
            'query' => [
                'student_code' => $student_code,
                'university_name' => $university_name
            ]
        ]);
        $payload = $res->getBody()->getContents();
        return Server::attachment($payload);
    }
}
