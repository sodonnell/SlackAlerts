<?php

namespace SlackAlerts;

class SlackAlerts
{
    private static $curl;
    protected static $data;

    private static $api_url = 'https://slack.com/api/chat.postMessage';
    private static $token;

    public static $response;
    public static $error;
    public static $info;
    
    public function __construct()
    {
        print "--- SlackAlerts.v1.0 ---\n";
        return;
    }
    public static function init($token)
    {
        self::$token = $token;
        self::$curl = curl_init();
        self::set_default_opts();
        self::set_default_data();
    }

    private function set_default_opts()
    {
        curl_setopt_array(self::$curl, array(
          CURLOPT_URL => self::$api_url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_HTTPHEADER => array(
            "Cache-Control: no-cache",
            "Content-Type: application/json",
            "Authorization: Bearer ". self::$token
          ),
        ));
    }

    private function set_default_data()
    {
        self::$data = array(
            'type' => 'message',
            'channel' => 'spacetrack',
            'icon_emoji' => ':space_invader:',
            'username' => 'SpaceTrackBot',
            'text' => 'default text; '.__FILE__,
        );
    }

    public static function setIconEmoji($icon)
    {
        self::$data['icon_emoji'] = $icon;
    }

    public static function setChannel($channel)
    {
        self::$data['channel'] = $channel;
    }

    public static function setUsername($username)
    {
        self::$data['username'] = $username;
    }

    public static function setMessage($msg)
    {
        self::$data['text'] = $msg;
    }

    public static function sendAlert()
    {
        curl_setopt(self::$curl,CURLOPT_POSTFIELDS,json_encode(self::$data));

        self::$response = curl_exec(self::$curl);
        self::$error = curl_error(self::$curl);

        curl_close(self::$curl);

        if (self::$error)
        {
            print "cURL Error #:" . self::$error . PHP_EOL;
        }
        else
        {
            print self::$response . PHP_EOL;
        }
    }
}

