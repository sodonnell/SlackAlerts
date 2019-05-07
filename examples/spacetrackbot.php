<?php
require 'vendor/autoload.php';

use SlackAlerts\SlackAlerts;

// slack app/bot token
$token = "xoxb-000000000000-000000000000-d7a8d987a8asd7789ds7a878";

SlackBot::init($token);
SlackBot::setChannel('spacetrack');
SlackBot::setMessage('Aliens!');
SlackBot::sendAlert();
