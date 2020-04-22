<?php

namespace App\Services\Messengers\Chats;

use App\Services\Responses\Server;
use App\User;

class Response
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function universityName()
    {
        $hosts = config('messenger.hosts');
        $items = [];
        foreach ($hosts as $key => $value) {
            $item = [
                "title" => $key,
                "postback_payload" => $key
            ];
            array_push($items, $item);
        }
        $payload = [
            "text" => "Chọn tên trường đại học bạn muốn xem",
            "items" => $items
        ];
        return Server::textQuickReplies($payload);
    }

    public function studentCode()
    {
        $payload = "Nhập vào mã sinh viên: ";
        return Server::text($payload);
    }

    public function end($messenger_id)
    {
        $this->user->setMessengerId($messenger_id);
        $payload = "Hoàn tất thiết lập. Chào mừng " . $this->user->getFullName();
        return Server::text($payload);
    }
}
