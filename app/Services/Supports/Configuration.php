<?php

namespace App\Services\Supports;

abstract class Configuration
{
    private $client;
    private $token;
    private $end_point;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
        $this->token = config("messenger.token");
    }

    public function getClient()
    {
        return $this->client;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setEndPoint($end_point)
    {
        $this->end_point = $end_point;
    }

    public function getEndPoint()
    {
        return $this->end_point;
    }
}
