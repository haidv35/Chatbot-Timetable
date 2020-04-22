<?php

namespace App\Services\Messengers\Configurations;

use App\Services\Supports\Configuration;

class GetStarted extends Configuration
{
    public function __construct()
    {
        parent::__construct();
        $this->setEndPoint(config("messenger.profile") . $this->getToken());
    }

    public function send()
    {
        try {
            $this->getClient()->request("POST", $this->getEndPoint(), [
                "json" => [
                    "get_started" => [
                        "payload" => "START_CHAT"
                    ]
                ]
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
