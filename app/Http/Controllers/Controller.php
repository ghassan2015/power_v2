<?php

namespace App\Http\Controllers;

use App\SmsMessageSettings;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function send($mobile, $message)
    {
        $settings = SmsMessageSettings::query()->find(1);
        $mobile = "&" . (substr($settings->sms_to, -1) == "=" ? $settings->sms_to . $mobile : $settings->sms_to . "=" . $mobile);
        $message = "&" . (substr($settings->sms_message, -1) == "=" ? $settings->sms_message . urlencode($message) : $settings->sms_message . "=" . urlencode($message));
        $url = $settings->sms_url . $mobile . $message;
        return $this->getCurldata($url);
    }

}
