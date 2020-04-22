<?php

namespace App\Services\Messengers\Configurations;

use App\Services\Supports\Configuration;

class PersistentMenu extends Configuration
{
    public function __construct()
    {
        parent::__construct();
    }

    public function edit()
    {
        $this->setEndPoint(config("messenger.profile") . $this->getToken());
        try {
            $this->getClient()->request("POST", $this->getEndPoint(), [
                "json" => [
                    "persistent_menu" => [
                        [
                            "locale" => "default",
                            "composer_input_disabled" => "false",
                            "call_to_actions" => [
                                [
                                    "type" => "postback",
                                    "title" => "Thời khoá biểu tuần dạng ảnh",
                                    "payload" => "VIEW_IMAGE_TIME_TABLE"
                                ],
                                [
                                    "type" => "postback",
                                    "title" => "Xem thời khoá biểu hôm nay",
                                    "payload" => "VIEW_TODAY_TEXT_TIME_TABLE"
                                ],
                                [
                                    "type" => "postback",
                                    "title" => "Thời khoá biểu tuần dạng chữ",
                                    "payload" => "VIEW_WEEK_TEXT_TIME_TABLE"
                                ]
                            ]
                        ]
                    ]
                ]
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    public function editUser($psid)
    {
        $this->setEndPoint(config("messenger.custom_user_settings") . $this->getToken());
        try {
            $this->getClient()->request("POST", $this->getEndPoint(), [
                "json" => [
                    "psid" => $psid,
                    "persistent_menu" => [
                        [
                            "locale" => "default",
                            "composer_input_disabled" => "false",
                            "call_to_actions" => [
                                [
                                    "type" => "postback",
                                    "title" => "Xem dạng ảnh thời khoá biểu",
                                    "payload" => "VIEW_TABLE_TIME_IMAGE"
                                ],
                                [
                                    "type" => "postback",
                                    "title" => "Xem dạng chữ thời khoá biểu",
                                    "payload" => "VIEW_TABLE_TIME_TEXT"
                                ]
                            ]
                        ]
                    ]
                ]
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function deleteUser($psid)
    {
        $this->setEndPoint(config("messenger.custom_user_settings") . $psid . "&params=[%22persistent_menu%22]&access_token=" . $this->getToken());
        try {
            $this->client->request("DELETE", $this->getEndPoint());
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
