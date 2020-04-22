<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Storage;

use KubAT\PhpSimple\HtmlDomParser;
use Goutte\Client;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Services\Utils\ParseHtml;

use App\Services\Messengers\Chats\Handle as ChatHandle;
use App\Services\Utils\ExistsStudentCode;
use App\User;

use App\Services\APIs\Dom;
use App\Services\APIs\ImageScheduleWeek;
use App\Services\APIs\TextScheduleToday;
use App\Services\APIs\TextScheduleWeek;

class WebhookController extends Controller
{

    private $chat;
    private $university_name;
    private $student_code;

    public function __construct(ChatHandle $chat)
    {
        $this->chat = $chat;
    }

    public function index(Request $request)
    {
        if ($request->hub_mode == "subscribe" && $request->hub_verify_token == "cl0v3r") {
            echo $request->hub_challenge;
            die();
        }
        $requestData = $request->all();
        $this->chat->init($requestData);
        $this->chat->handle();
    }

    public function getDom($university_name, $student_code)
    {
        return Dom::query($university_name, $student_code);
    }

    public function getQueryParams()
    {
        $this->university_name = isset($_GET['university_name']) ? $_GET['university_name'] : null;
        $this->student_code = isset($_GET['student_code']) ? $_GET['student_code'] : null;
        if(is_null($this->university_name) || is_null($this->student_code)){
            return false;
        }
        return true;
    }

    public function getImage()
    {
        try {
            return $this->getQueryParams() ? ImageScheduleWeek::query($this->getDom($this->university_name, $this->student_code)) : '';
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function existsStudentCode()
    {
        try {
            $query = $this->getQueryParams() ? ExistsStudentCode::query($this->getDom($this->university_name, $this->student_code)) : false;
            if ($query === true) {
                return "true";
            } else {
                return "false";
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getTodayText()
    {
        try {
            return $this->getQueryParams() ? TextScheduleToday::query($this->getDom($this->university_name, $this->student_code)) : '';
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getWeekText()
    {
        try {
            return $this->getQueryParams() ? TextScheduleWeek::query($this->getDom($this->university_name, $this->student_code)) : '';
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
