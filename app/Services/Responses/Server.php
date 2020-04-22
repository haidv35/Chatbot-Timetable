<?php

namespace App\Services\Responses;


class Server
{
    private static $end_point;
    private static $messenger_id;

    // public static function setEndPoint($end_point)
    // {
    //     self::$end_point = $end_point;
    // }

    // public static function setMessengerId($messenger_id)
    // {
    //     self::$messenger_id = $messenger_id;
    // }

    public static function init($end_point, $messenger_id)
    {
        self::$end_point = $end_point;
        self::$messenger_id = $messenger_id;
    }

    public static function text($payload)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $client->request("POST", self::$end_point, [
                "json" => [
                    "recipient" => [
                        "id" => self::$messenger_id
                    ],
                    "message" => [
                        "text" => $payload
                    ]
                ]
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function attachment($payload)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $client->request("POST", self::$end_point, [
                "json" => [
                    "recipient" => [
                        "id" => self::$messenger_id
                    ],
                    "message" => [
                        "attachment" => [
                            "type" => "image",
                            "payload" => [
                                "is_reusable" => "true",
                                "url" => $payload
                            ]
                        ]
                    ]
                ]
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function textQuickReplies($payload)
    {
        try {
            $buttons = [];
            foreach ($payload["items"] as $key => $item) {
                $button = [
                    "content_type" => "text",
                    "title" => $item["title"],
                    "payload" => $item["postback_payload"],
                    "image_url" => isset($item["image_url"]) ? $item["image_url"] : ""
                ];
                array_push($buttons, $button);
            }
            $client = new \GuzzleHttp\Client();
            $res = $client->request("POST", self::$end_point, [
                "json" => [
                    "recipient" => [
                        "id" => self::$messenger_id
                    ],
                    "messaging_type" => "RESPONSE",
                    "message" => [
                        "text" => $payload["text"],
                        "quick_replies" => $buttons
                    ]
                ]
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
