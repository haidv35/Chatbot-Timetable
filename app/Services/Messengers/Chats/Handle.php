<?php

namespace App\Services\Messengers\Chats;

use App\Services\Responses\Facebook;
use App\Services\Responses\Server;
use Illuminate\Support\Facades\Log;
use App\User;
use App\Services\Messengers\Chats\Time;

use App\Services\Messengers\TimeTables\Text\Week as WeekText;
use App\Services\Messengers\TimeTables\Text\Today as TodayText;
use App\Services\Messengers\TimeTables\Image\Week as WeekImage;

use App\Services\Messengers\Chats\Handle\Information;

class TimeTable
{
    const VIEW_IMAGE_TIME_TABLE = "VIEW_IMAGE_TIME_TABLE";
    const VIEW_TODAY_TEXT_TIME_TABLE = "VIEW_TODAY_TEXT_TIME_TABLE";
    const VIEW_WEEK_TEXT_TIME_TABLE = "VIEW_WEEK_TEXT_TIME_TABLE";
}

class Handle
{
    private $user;
    private $information;
    private $requestData;
    private $end_point;
    private $messenger_id;


    public function __construct(User $user, Information $information)
    {
        $this->user = $user;
        $this->information = $information;
    }

    public function init($requestData)
    {
        $this->requestData = $requestData;
        $this->end_point = config("messenger.message") . config("messenger.token");
    }

    public function setMessengerId($messenger_id)
    {
        $this->messenger_id = $messenger_id;
        $this->user->setMessengerId($this->messenger_id);
        $this->information->setMessengerId($this->messenger_id);
        Server::init($this->end_point, $this->messenger_id);
    }


    public function defaultResponse()
    {
        $payload = " *" . $this->user->getFullName() . "*" . Time::checkTime();
        Server::text($payload);
    }

    public function loadingResponse()
    {
        // $loading_img = glob("loading/" . '*.{gif}', GLOB_BRACE);
        // $randomImage = $loading_img[array_rand($loading_img)];
        // $payload = asset($randomImage);

        $payload = "Đang tải...";
        Server::text($payload);
        // Server::attachment($payload);
    }

    public function imageResponse()
    {
        WeekImage::send($this->user->getStudentCode(), $this->user->getUniversityName());
    }

    public function todayTextResponse()
    {
        TodayText::send($this->user->getStudentCode(), $this->user->getUniversityName());
    }

    public function weekTextResponse()
    {
        WeekText::send($this->user->getStudentCode(), $this->user->getUniversityName());
    }

    public function getInformation($data)
    {
        $this->information->query($data, $this->messenger_id);
    }

    public function handle()
    {
        $data = isset($this->requestData["entry"][0]["messaging"]) ? $this->requestData["entry"][0]["messaging"][0] : null;
        if ($data === null) {
            die();
        }
        $this->setMessengerId($data["sender"]["id"]);
        //Handle request
        if (!$this->user->exists()) {
            $this->user->storeId();
            $this->information->update();
        } else {
            if ($this->user->getUniversityName() !== null && $this->user->getStudentCode() !== null) {
                if (empty($data["postback"])) {
                    return $this->defaultResponse();
                }
                $this->loadingResponse();
                switch ($data["postback"]["payload"]) {
                    case TimeTable::VIEW_IMAGE_TIME_TABLE:
                        $this->imageResponse();
                        break;
                    case TimeTable::VIEW_TODAY_TEXT_TIME_TABLE:
                        $this->todayTextResponse();
                        break;
                    case TimeTable::VIEW_WEEK_TEXT_TIME_TABLE:
                        $this->weekTextResponse();
                        break;
                }
            }
        }
        //Get user information and then store it
        $this->getInformation($data);
    }
}
