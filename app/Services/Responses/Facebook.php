<?php

namespace App\Services\Responses;

class Facebook
{
    private $messenger_id;

    public function setMessengerId($messenger_id)
    {
        $this->messenger_id = $messenger_id;
    }

    public function userInformation()
    {
        $end_point = "https://graph.facebook.com/" . $this->messenger_id . "?fields=first_name,last_name,profile_pic,locale,gender&access_token=" . config("messenger.token");
        $client = new \GuzzleHttp\Client();
        $res = $client->request("GET", $end_point);
        return $res->getBody();
    }
}
