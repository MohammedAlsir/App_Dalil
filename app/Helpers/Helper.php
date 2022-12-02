<?php

namespace App\Helpers;

use App\Models\Setting;
use App\Models\User;

class Helper
{
    static function GeneralSiteSettings($var)
    {
        $Setting = Setting::find(1);
        return $Setting->$var;
    }

    // لجلب بيانات المستخدم الاول
    static function GetFirstUser($var)
    {
        $user = User::find(1);
        return $user->$var;
    }

    static function languageName($Language)
    {
        $language_title = "<span class='label light text-dark lang-label'>";
        if (!empty($Language)) {
            // if ($Language != "") {
            $language_title .= "<img src=\"" . asset('images/flags/' . $Language . '.svg') . "\" alt=\"\">";
            // }
            $language_title .= " <small>" . $Language->title . "</small></span>";
        }
        return $language_title;
    }
}