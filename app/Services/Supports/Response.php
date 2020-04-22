<?php

namespace App\Services\Supports;

use GuzzleHttp\Client;

abstract class Response
{
    private $messenger_id;
    private $end_point;
    private $client;
    private static $instance;

    public function getInstance($messenger_id, $end_point)
    {
        $this->messenger_id = isset($messenger_id) ? $messenger_id : null;
        $this->end_point = isset($end_point) ? $end_point : null;
        $this->client = new Client();
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function setMessengerId($messenger_id)
    {
        $this->messenger_id = $messenger_id;
    }

    public function getMessengerId()
    {
        return $this->messenger_id;
    }

    public function setEndPoint($end_point)
    {
        $this->end_point = $end_point;
    }

    public function getEndPoint()
    {
        return $this->end_point;
    }

    public function getClient()
    {
        return $this->client;
    }
}
