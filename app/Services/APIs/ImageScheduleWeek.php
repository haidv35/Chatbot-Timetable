<?php

namespace App\Services\APIs;

use App\Services\Utils\ConvertToImage;
use Carbon\Carbon;
use App\Services\Contracts\API;

class ImageScheduleWeek implements API
{
    public static function query($dom)
    {
        $image = ConvertToImage::result($dom);
        return $image;
        // echo "<img src=\"$image\" />";
    }
}
