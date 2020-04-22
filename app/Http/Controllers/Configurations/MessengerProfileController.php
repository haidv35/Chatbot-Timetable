<?php

namespace App\Http\Controllers\Configurations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Messengers\Configurations\MessengerProfile;

class MessengerProfileController extends Controller
{

    private $messenger_profile;

    public function __construct(MessengerProfile $messenger_profile)
    {
        $this->messenger_profile = $messenger_profile;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "<pre>";
        print_r(json_decode($this->messenger_profile->send()));
        echo "</pre>";
    }
}
