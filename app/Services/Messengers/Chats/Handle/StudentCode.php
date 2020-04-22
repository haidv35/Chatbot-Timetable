<?php

namespace App\Services\Messengers\Chats\Handle;

class StudentCode
{
    public static function query($student_code, $university_name)
    {
        $client = new \GuzzleHttp\Client();
        $res = $client->request("GET", route('exists_student_code'), [
            'query' => [
                'student_code' => $student_code,
                'university_name' => $university_name
            ]
        ]);
        return $res->getBody()->getContents();
    }
}
