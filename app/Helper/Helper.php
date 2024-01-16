<?php

namespace App\Helper;

use App\Models\Setting;


class Helper
{
    static function Settings()
    {
        $setting_helper = Setting::first();

        return $setting_helper;
    }
}
