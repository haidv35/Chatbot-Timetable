<?php

namespace App\Services\Messengers\Configurations;

use App\Services\Supports\Configuration;

class MessengerProfile extends Configuration
{
    public function __construct()
    {
        parent::__construct();
        $this->setEndPoint(config("messenger.profile"));
    }

    public function send()
    {
        /*
        https://graph.facebook.com/v6.0/me/messenger_profile?fields=get_started,greeting,persistent_menu&access_token=EAAmr0XrawOABAHRI3PuSILiBmjZCjQhHnhPPZCkDaYYsQDKgtahISfrNmL8K1VzxOYnCgVqaxNmRlDPKg7ouLyGXZBrUfETZBX07o1e5e9zbuayxP4Q27ZBIz6M34adNEx1qPgsN5jrPbIZC189LVhtLuzYOVZCfDxmFz9vMVXatsiIm5cSLnQ309MHloZCGt0AZD
        */
        try {
            $res = $this->getClient()->request("GET", $this->getEndPoint(), [
                "query" => [
                    "access_token" => $this->getToken(),
                    "fields" => "get_started,greeting,persistent_menu"
                ]
            ]);
            return $res->getBody();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
