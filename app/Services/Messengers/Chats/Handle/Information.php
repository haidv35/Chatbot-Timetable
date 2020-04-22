<?php

namespace App\Services\Messengers\Chats\Handle;

use App\Services\Messengers\Chats\Handle\StudentCode;
use App\Services\Messengers\Chats\Response as ChatResponse;
use App\Services\Responses\Facebook;
use App\User;

use Illuminate\Support\Facades\Log;

class Information
{
    private $response;
    private $user;
    private $messenger_id;
    public function __construct(ChatResponse $response, User $user, Facebook $facebook)
    {
        $this->response = $response;
        $this->user = $user;
        $this->facebook = $facebook;
    }

    public function setMessengerId($messenger_id)
    {
        $this->messenger_id = $messenger_id;
        $this->user->setMessengerId($this->messenger_id);
        $this->facebook->setMessengerId($this->messenger_id);
    }

    public function getMessengerId()
    {
        return $this->messenger_id;
    }

    public function query($data)
    {
        if (isset($data["postback"]) && $data["postback"]["payload"] === "START_CHAT") {
            $this->askUniversityName();
        } else if ($this->user->getUniversityName() === null && empty($data["message"]["quick_reply"]["payload"])) {
            $this->askUniversityName();
        } else {
            $payload = isset($data["message"]["quick_reply"]["payload"]) ? $data["message"]["quick_reply"]["payload"] : null;
            $this->askStudentCode($payload);

            $payload = isset($data["message"]["text"]) ? $data["message"]["text"] : null;
            $this->end($payload);
        }
    }

    public function askUniversityName()
    {
        return $this->response->universityName();
    }

    public function askStudentCode($payload)
    {
        if ($payload !== null) {
            $hosts = config("messenger.hosts");
            foreach ($hosts as $key => $value) {
                if ($key === $payload) {
                    $this->user->updateUniversityName($payload);
                    return $this->response->studentCode();
                }
            }
        }
    }

    public function end($payload)
    {
        if ($payload === null) {
            die();
        }
        if ($this->user->getStudentCode() !== null) {
            die();
        }
        if (StudentCode::query($payload, $this->user->getUniversityName()) === "true") {
            $this->user->updateStudentCode($payload);
            return $this->response->end($this->getMessengerId());
        } else {
            return $this->response->studentCode();
        }
    }

    public function update()
    {
        $res = $this->facebook->userInformation();
        $this->user->updateMessengerInformation($res);
    }
}
