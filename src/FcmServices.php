<?php

namespace Ductho1201\FcmServices;

class FCMService
{
    private $fcmKey;

    public function __construct()
    {

    }

    public function sendNotification($title, $content, $fcmTokens = [], $data = [])
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $data = [
            "registration_ids" => $fcmTokens,
            "notification" => [
                "title" => $title,
                "body" => $content,
                "data" => $data
            ]
        ];
        $postData = json_encode($data);
        $headers = [
            'Authorization:key=' . $this->fcmKey,
            'Content-Type: application/json',
        ];

        // CURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        $output = curl_exec($ch);
        curl_close($ch);
    }

    /**
     * @param $key
     */
    public function setFcmKey($key)
    {
        $this->fcmKey = $key;
    }
}