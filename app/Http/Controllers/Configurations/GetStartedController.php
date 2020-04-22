<?php

namespace App\Http\Controllers\Configurations;

use App\Http\Controllers\Controller;
use App\Services\Messengers\Configurations\GetStarted;
use Illuminate\Http\Request;

class GetStartedController extends Controller
{
    private $get_started;
    public function __construct(GetStarted $get_started)
    {
        $this->get_started = $get_started;
    }

    public function update()
    {
        return $this->get_started->send();
    }
}
